<?php


namespace App\Http\Controllers;


use App\Http\Responses\Response;
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
        return Response::Success($result, 'User Created Successfully');

    }

    public function login(Request $request)
    {
        try {
            $result = $this->authService->login($request);
            return Response::Success($result, 'User Logged In Successfully');
        } catch (\Exception $e) {
            return Response::Error( $e->getMessage(), $e->getCode() ?: 400);

        }
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return Response::Success(null, 'User Sign out successful');

    }
}
