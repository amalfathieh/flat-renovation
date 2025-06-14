<?php


namespace App\Http\Controllers;


use App\Http\Requests\RegisterRequest;
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

    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register($request);
        return Response::Success($result, __('strings.verification_code_sent'));


    }

    public function login(Request $request)
    {
        try {
            $result = $this->authService->login($request);
            return Response::Success($result,  __('strings.user_logged_in_successfully'));
        } catch (\Exception $e) {
            return Response::Error( $e->getMessage(), $e->getCode() ?: 400);

        }
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return Response::Success(null, __('strings.user_logged_out_successfully'));

    }
}
