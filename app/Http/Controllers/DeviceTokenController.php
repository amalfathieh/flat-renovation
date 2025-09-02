<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class DeviceTokenController extends Controller
{
    public function store(Request $request){

        $user = Auth::user();
        $deviceToken = $request->post('token');

        if($user->device_token != $deviceToken){
                $user->device_token = $deviceToken;
                $user->save();
        }

        return Response::json(['status' => 'ok']);
    }

}
