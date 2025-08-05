<?php

namespace App\Http\Controllers;

use App\Http\Resources\StageResource;
use App\Http\Responses\Response;
use App\Models\ProjectStage;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\stage_transactions;
use App\Models\Transaction;
use App\Models\TransactionsAll;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectStageController extends Controller
{
    public function getProjectStages($id)
    {
        try {
            $projectStages = ProjectStage::with('imagesStage')->where('project_id', $id)->get();

            return Response::Success(StageResource::collection($projectStages), 'success');
        } catch (\Exception $ex) {
            return Response::Error($ex->getMessage(), $ex->getCode() ?: 404);
        }
    }

    public function getServiceTypes($id)
    {
        $service = Service::find($id)->first();
        if (!$service) {
            return Response::Error('error service');
        }
        return Response::Success($service->serviceTypes, 'success');
    }

    public function editServiceType($id, Request $request)
    {
        $request->validate([
            'service_type_id' => ['required', 'int'],
        ]);
        $stage = ProjectStage::where('id', $id)->first();

        if (!$stage) {
            return Response::Error('not found', 404);
        }
        if ($stage->project->customer_id != Auth::id()) {
            return Response::Error(__('strings.authorization_required'));
        }

        $serviceType = ServiceType::where('id', $request->service_type_id)->first();

        if (!$serviceType) {
            return Response::Error('error type');
        }
        $stage->service_type_id = $serviceType->id;
        $stage->save();

        return Response::Success($stage, __('strings.updated_successfully'));
    }



    //================================================================================

    // safa



    public function createStagePaymentIntent($stageId)
    {


        $stage = ProjectStage::query()->where('id', $stageId)->first();

        if (!$stage) {
            return response()->json(['message' => 'Stage not found.'], 404);
        }

        $amount = $stage->cost;

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => intval($amount * 100),
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            return response()->json([
                'status' => true,
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id,
                'amount' => $amount,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    //--------------------------------------------------------------------------------




    public function confirmStagePayment(Request $request, $stageId)
    {
        $request->validate([
            'payment_intent_id' => 'required|string',
        ]);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            $paymentIntent = \Stripe\PaymentIntent::retrieve($request['payment_intent_id']);

            if ($paymentIntent->status !== 'succeeded') {
                return response()->json([
                    'status' => false,
                    'actual_status' => $paymentIntent->status,
                    'message' => 'الدفع لم يكتمل.'
                ], 400);
            }

            $stage = ProjectStage::query()->where('id', $stageId)->first();

            if (!$stage) {
                return response()->json(['message' => 'Stage not found.'], 404);
            }

            $project = $stage->project;
            $company = $project->company;
            $customer = $project->order->customer;


            $company->increment('balance', $stage->cost);


            $stage->update([
                'payment_intent_id' => $paymentIntent->id,
                 'is_confirmed'=>true,
            ]);


            stage_transactions::create([
                'project_stage_id' => $stage->id,
                'company_id' => $company->id,
                'customer_id' => $customer->id,
                'payment_intent_id' => $paymentIntent->id,
                'type' => 'credit',
                'amount' => $stage->cost,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'تم الدفع بنجاح للمرحلة.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }



//-------------------------------------------------------------------------



    public function confirmStage($stageId)
    {
        try {
            DB::beginTransaction();

            $stage = ProjectStage::find($stageId);

            if (!$stage) {
                return response()->json(['status' => false, 'message' => 'المرحلة غير موجودة.'], 404);
            }

            if ($stage->is_confirmed) {
                return response()->json(['status' => false, 'message' => 'تم تأكيد المرحلة سابقًا.'], 400);
            }

            $project = $stage->project;
            $company = $project->company;
            $companyUser = $company->user;
            $customer = $project->order->customer()->with('user')->first();
            $customerUser = $customer->user;

            $amount = $stage->cost;


            if ($customerUser->balance < $amount) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'رصيدك غير كافٍ لدفع هذه المرحلة. الرجاء الشحن ثم المحاولة مجددًا.',
                ], 400);
            }


            $customerUser->decrement('balance', $amount);


            $companyUser->increment('balance', $amount);


            $stage->update([
                'is_confirmed' => true,
            ]);
            $service = new InvoiceService();
            $invoice = $service->generateInvoiceNumber();



            TransactionsAll::create([
                'payer_type' => get_class($customer),
                'payer_id' => $customer->id,
                'receiver_type' => get_class($company),
                'receiver_id' => $company->id,
                'source' => 'user_stage_payment',
                'amount' => $amount,
                'note' => 'دفع مرحلة من مشروع',
               'related_type' => get_class($stage),
               'related_id' => $stage->id,
                'invoice_number' => $invoice,
        ]);

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'تم تأكيد ودفع المرحلة بنجاح.',
        ]);
    } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'فشل في إتمام الدفع: ' . $e->getMessage(),
            ], 500);
        }
    }











}
