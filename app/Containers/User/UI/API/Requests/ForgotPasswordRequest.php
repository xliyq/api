<?php


namespace App\Containers\User\UI\API\Requests;


use Porto\Core\Requests\Request;

class ForgotPasswordRequest extends Request
{
    public function rules() {
        return [
            'phone' => 'required|size:11',
        ];
    }
}