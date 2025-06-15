<?php

namespace App\Http\Controllers;

use App\Services\Auth\CustomerProfileService;
use Illuminate\Http\Request;
use App\Http\Responses\Response; // ✅ استدعاء كلاس Response

class CustomerProfileController extends Controller
{
    protected $profileService;

    public function __construct(CustomerProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function show(Request $request)
    {
        $data = $this->profileService->show($request->user());
        return Response::success(['user' => $data], 'تم جلب البيانات بنجاح');
    }

    public function update(Request $request)
    {
        $data = $this->profileService->update($request, $request->user());
        return Response::success(['user' => $data], 'تم تحديث البيانات بنجاح');
    }

    public function changePassword(Request $request)
    {
        $result = $this->profileService->changePassword($request, $request->user());

        if (isset($result['error'])) {
            return Response::error($result['error'], 403);
        }

        return Response::success(null, $result['message']);
    }
}
