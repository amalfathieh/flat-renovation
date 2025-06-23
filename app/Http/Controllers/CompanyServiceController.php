<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\QuestionService;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyServiceController extends Controller
{


    public function index($id)
    {
        $company=Company::query()->where('id', '=', $id)->first();

        $services = $company->services()->select('id', 'name', 'description', 'image')->get();

        return response()->json([
            'company_id' => $company->id,
            'company_name' => $company->name,
            'services' => $services
        ]);
    }


    //===============================================================================


    public function getQuestionsForServices(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'service_ids' => 'required|array|min:1',
            'service_ids.*' => 'integer|exists:services,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $serviceIds = $request->input('service_ids');

        $services = Service::with(['questions', 'serviceTypes']) // نحتاج العلاقات
        ->whereIn('id', $serviceIds)
            ->get()
            ->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'questions' => $service->questions->map(function ($q) use ($service) {
                        $questionData = [
                            'id' => $q->id,
                            'question' => $q->question,
                            'has_options' => (bool) $q->has_options,
                        ];


                        if ($q->has_options) {
                            $questionData['options'] = $service->serviceTypes->map(function ($type) {
                                return [
                                    'id' => $type->id,
                                    'name' => $type->name,
                                    'unit' => $type->unit,
                                    'price' => $type->price_per_unit,
                                ];
                            });
                        }

                        return $questionData;
                    }),
                ];
            });

        return response()->json([
            'status' => true,
            'data' => $services
        ]);
    }


    //----------------------------------------------------------------------------------------------

    public function calculateSurveyCost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'services' => 'required|array|min:1',
            'services.*.service_id' => 'required|integer|exists:services,id',
            'services.*.answers' => 'required|array|min:1',
            'services.*.answers.*.question_id' => 'required|integer|exists:question_services,id',
            'services.*.answers.*.answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $grandTotal = 0;

        foreach ($request->services as $serviceData) {
            $answers = $serviceData['answers'];

            foreach ($answers as $item) {
                $question = QuestionService::find($item['question_id']);

                if ($question->has_options) {
                    $serviceTypeId = intval($item['answer']);
                    $serviceType = ServiceType::find($serviceTypeId);

                    if ($serviceType) {
                        
                        $quantity = null;
                        foreach ($answers as $q) {
                            if ($q['question_id'] !== $item['question_id']) {
                                $relatedQuestion = QuestionService::find($q['question_id']);
                                if (str_contains($relatedQuestion->question, 'مساحة') || str_contains($relatedQuestion->question, 'عدد')) {
                                    $quantity = floatval($q['answer']);
                                    break;
                                }
                            }
                        }

                        if ($quantity !== null && is_numeric($quantity)) {
                            $grandTotal += $quantity * $serviceType->price_per_unit;
                        }
                    }
                }
            }
        }

        return response()->json([
            'status' => true,
            'total_price' => $grandTotal
        ]);
    }


}
