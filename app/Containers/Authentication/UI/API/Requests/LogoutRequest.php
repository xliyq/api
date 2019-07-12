<?php


namespace App\Containers\Authentication\UI\API\Requests;


use Porto\Core\Requests\Request;

class LogoutRequest extends Request
{
    protected $access = [];

    protected $decode = [];

    protected $urlParameters = [];

    public function rules() {
        return [];
    }

    public function authorize() {
        return $this->check(
            [
                'hasAccess',
            ]
        );
    }
}