<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{

    public function confirm($planId, SubscriptionService $subscriptionService)
    {
        $result = $subscriptionService->subscribe(auth()->user(), $planId);

        $status = $result['success'] ? 200 : 400;
        return response()->json($result, $status);
    }
}
