<?php


namespace App\Http\Controllers;


use App\Services\Auth\CustomerAuthServiceInterface;
use Illuminate\Http\Request;

class CustomerAuthController extends Controller
{
    protected $authService;

    public function __construct(CustomerAuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $result = $this->authService->register($request);
        return response()->json($result);
    }

    public function login(Request $request)
    {
        try {
            $result = $this->authService->login($request);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 400);
        }
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return response()->json(['message' => 'Sign out successful']);
    }
}
