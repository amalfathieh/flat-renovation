<?php


namespace App\Responses;


use Nette\Schema\ValidationException;
use Ramsey\Uuid\Rfc4122\Validator;

class Response
{
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|min:3',  // تم تصحيح النسبة المئوية % إلى رقم 3
            'password' => 'required|confirmed|min:8',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Throw a ValidationException with the translated error messages
        throw new ValidationException($validator, Response::Validation([], $validator->errors()));
    }
}
