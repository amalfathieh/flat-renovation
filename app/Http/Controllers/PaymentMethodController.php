<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use App\Models\PaymentMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function getActivePaymentMethods(): JsonResponse
    {
        $methods = PaymentMethod::where('is_active', true)
            ->select('id', 'name', 'instructions')
            ->get();

        return Response::Success($methods, 'All Methods.');

    }

}
