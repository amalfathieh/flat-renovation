<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopUpRequest;
use App\Http\Responses\Response;
use App\Models\TopUpRequest;
use App\Models\User;
use App\Services\TopUpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopupRequestController extends Controller
{


    public function adminInfo()
    {
        $admin = User::role('admin')->first();

        if (!$admin) {
            return response()->json(['error' => 'لم يتم العثور على الأدمن'], 404);
        }

        return response()->json([
            'admin_name' => $admin->name,
            'admin_phone' => $admin->phone,
            'instructions' => 'يرجى التحويل إلى حساب الأدمن ثم رفع صورة الوصل',
        ]);

    }

    public function creatTopUp(StoreTopUpRequest $request, TopUpService $topUpService): \Illuminate\Http\JsonResponse
    {
        try {
            $user = auth()->user();

            $model = $user->customerProfile;

            if (!$model) {
                return Response::Error('Unauthorized requester', 403);
            }
            $request->merge(['model' => $model]); // Add model to request
            $topUp = $topUpService->submitTopUp($request); // Pass request object

            return Response::Success($topUp, 'Top-up request submitted successfully.');

        }catch (\Exception $ex) {
            return Response::Error($ex->getMessage(), $ex->getCode() ?: 404);
        }
    }

    public function getMyTopUpRequests(Request $request)
    {
        $customer = Auth::user()->customerProfile;


        $query = TopUpRequest::query()
            ->where('requester_id', $customer->id)
            ->where('requester_type', get_class($customer));

        if ($request->has('status')) {
            $status = $request->input('status');
            if (in_array($status, ['pending', 'approved', 'rejected'])) {
                $query->where('status', $status);
            }
        }

        $requests = $query->latest()->paginate(10); // أو ->get() لو بدك بدون pagination

//        $requests = $query->latest()->get(); // أو ->get() لو بدك بدون pagination

        return response()->json([
            'status' => true,
            'requests' => $requests,
        ]);
    }
//    public function getMyTopUpRequests(Request $request)
//    {
//        $customer = Auth::user()->customerProfile;
//
////        $customer = Auth::guard('sanctum')->user();
//
//        $requests = TopUpRequest::with('paymentMethod')->where('requester_id', $customer->id)
//            ->where('requester_type', get_class($customer))
//            ->latest()
//            ->paginate(10);
//
//        return Response::Success($requests, 'All Top-up request.');
//    }


}
