<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Auth\CustomerProfileService;
use Illuminate\Http\Request;

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
        return response()->json(['user' => $data]);
    }

    public function update(Request $request)
    {
        $data = $this->profileService->update($request, $request->user());
        return response()->json(['user' => $data]);
    }

    public function changePassword(Request $request)
    {
        $result = $this->profileService->changePassword($request, $request->user());

        if (isset($result['error'])) {
            return response()->json(['message' => $result['error']], 403);
        }

        return response()->json(['message' => $result['message']]);
    }
}
