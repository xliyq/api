<?php


namespace App\Containers\User\UI\API\Requests;


use Porto\Core\Requests\Request;

class GetAllUsersRequest extends Request
{
    protected $access = [
        'permissions' => 'list-users',
        'roles'       => 'admin'
    ];

    public function rules() {
        return [];
    }
}