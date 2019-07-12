<?php


namespace App\Containers\User\UI\API\Requests;


use Porto\Core\Requests\Request;

class RegisterUserRequest extends Request
{
    public function rules() {
        return [
            'phone'    => 'required|size:11|unique:users,phone',
            'password' => 'required|min:6|max:30',
            'name'     => 'required|min:2|max:30'
        ];
    }
}