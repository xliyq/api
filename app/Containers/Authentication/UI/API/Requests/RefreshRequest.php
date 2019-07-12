<?php


namespace App\Containers\Authentication\UI\API\Requests;


use Porto\Core\Requests\Request;

class RefreshRequest extends Request
{

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function rules() {
        return [];
    }

}