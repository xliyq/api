<?php


namespace App\Containers\User\UI\API\Requests;


use Porto\Core\Requests\Request;

class ResetPasswordRequest extends Request
{

    protected $urlParameters = [
    ];

    public function rules() {
        return [
            'phone'    => 'required|size:11',
            'password' => 'required|min:5|max:30',
        ];
    }
}