<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use App\Models\answer;
use App\Models\Order;

use App\Services\InvoiceService;



use App\Models\Transaction;

use App\Models\TransactionsAll;
use Illuminate\Support\Facades\DB;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class OrderController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
        ]);

        $company = Company::find($request->company_id);

        if (!$company) {
            return response()->json([
                'status' => false,
                'message' => 'الشركة غير موجودة.'
            ], 404);
        }

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            $amount = $company->cost_of_examination;

            $paymentIntent = PaymentIntent::create([
                'amount' => intval($amount * 100),
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            return response()->json([
                'status' => true,
                'payment_intent_id' => $paymentIntent->id,
                'client_secret' => $paymentIntent->client_secret,
                'amount' => $amount,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    //---------------------------------------------------------------------------------


    public function storeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'location' => 'required|string',
            'budget' => 'required|numeric',
            'answers' => 'required|array|min:1',
            'payment_intent_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {

            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

            if ($paymentIntent->status !== 'succeeded') {

                return response()->json([
                    'status' => false,
                    'actual_status' => $paymentIntent->status,
                    'message' => 'الدفع لم يتم بنجاح.'
                ], 400);
            }

            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'المستخدم غير مصادق. يرجى تسجيل الدخول.'
                ], 401);
            }

            $customer = Customer::where('user_id', $user->id)->first();
            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'الحساب الحالي ليس مرتبطًا بعميل (Customer).'
                ], 403);
            }

            $company = Company::find($request->company_id);

            $amount = $company->cost_of_examination;

            $order = Order::create([
                'customer_id' => $customer->id,
                'company_id' => $request->company_id,
                'location' => $request->location,
                'budget' => $request->budget,
                'cost_of_examination' => $company->cost_of_examination,
                'payment_intent_id' => $paymentIntent->id,
            ]);

            foreach ($request->answers as $answerData) {
                Answer::create([
                    'order_id' => $order->id,
                    'question_service_id' => $answerData['question_service_id'],
                    'answer' => $answerData['answer'],
                ]);
            }


            $company->increment('balance', $amount);


            Transaction::create([
                'company_id' => $company->id,
                'type' => 'credit',
                'amount' => $amount,
                'order_id' => $order->id,

            ]);


            return response()->json([
                'status' => true,
                'message' => 'تم إرسال الطلب بنجاح بعد الدفع.',
                'order_id' => $order->id
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    //---------------------------------------------------------------------------------

    // for testing payment ...
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $company = Company::findOrFail($request->company_id);
        $price = $company->cost_of_examination * 100;

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'كشف هندسي - ' . $company->name,
                    ],
                    'unit_amount' => $price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/payment-success?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('/payment-cancel'),
        ]);

        return response()->json([
            'url' => $session->url,
            'payment_intent_id' => $session->payment_intent,
        ]);
    }

    //------------------------------------------------------------------------------------------------------------------


    public function customerOrders(Request $request)
    {
        $customer = $request->user()->customerprofile;

        if (!$customer) {
            return Response::Error('العميل غير موجود', 404);
        }

        $orders = Order::with('company')
            ->where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $formattedOrders = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'status' => $order->status,
                'cost_of_examination' => $order->cost_of_examination,
                'location' => $order->location,
                'budget' => $order->budget,
                'created_at' => $order->created_at,

                'company' => [
                    'id' => $order->company->id,
                    'name' => $order->company->name,
                    'email' => $order->company->email,
                    'phone' => $order->company->phone,
                    'location' => $order->company->location,
                    'logo' => $order->company->logo
                ]
            ];
        });

        return Response::Success(
            ['orders' => $formattedOrders],
            'تم جلب الطلبات بنجاح'
        );
    }



    //---------------------------------------------------------------------------------------------------------------



    public function storeOrderWithWallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'location' => 'required|string',
            'budget' => 'required|numeric',
            'answers' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'المستخدم غير مصادق. يرجى تسجيل الدخول.'
                ], 401);
            }

            $customer = Customer::where('user_id', $user->id)->first();
            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'الحساب الحالي ليس مرتبطًا بعميل (Customer).'
                ], 403);
            }

            $company = Company::findOrFail($request->company_id);
            $amount = $company->cost_of_examination;


            if ($user->balance < $amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'رصيدك غير كافٍ لإجراء هذا الطلب. الرجاء شحن رصيدك أولاً.'
                ], 400);
            }


            $user->decrement('balance', $amount);


            $company->user->increment('balance', $amount);


            $order = Order::create([
                'customer_id' => $customer->id,
                'company_id' => $company->id,
                'location' => $request->location,
                'budget' => $request->budget,
                'cost_of_examination' => $amount,
            ]);


            foreach ($request->answers as $answerData) {
                Answer::create([
                    'order_id' => $order->id,
                    'question_service_id' => $answerData['question_service_id'],
                    'answer' => $answerData['answer'],
                ]);
            }


            $service = new InvoiceService();
            $invoice = $service->generateInvoiceNumber();


            TransactionsAll::create([
                'payer_type' => get_class($customer),
                'payer_id' => $customer->id,
                'receiver_type' => get_class($company),
                'receiver_id' => $company->id,
                'source' => 'user_order_payment',
                'amount' => $amount,
                'status' => 'completed',
                'note' => 'دفع قيمة طلب كشف.',
                'related_type' => get_class($order),
                'related_id' => $order->id,
                'invoice_number' =>$invoice,

            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'تم إرسال الطلب بنجاح والدفع من المحفظة.',
                'order_id' => $order->id
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'حدث خطأ أثناء معالجة الطلب: ' . $e->getMessage(),
            ], 500);
        }
    }




























}
