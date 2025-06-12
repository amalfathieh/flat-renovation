<?php


namespace App\Traits;

use App\Models\VerificationCode;
use App\Notifications\VerificationCodeNotification;

trait CodeTrait{

    public function sendVerificationCode($user){
        $data['email'] =  $user->email;
        $data['code'] = mt_rand(100000, 999999);
        VerificationCode::create($data);

        $user->notify(new VerificationCodeNotification($data['code']));

    }
}

