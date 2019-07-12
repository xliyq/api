<?php


namespace App\Containers\User\UI\API\Requests;

use Porto\Core\Requests\Request;

class CreateAdminRequest extends Request
{

    protected $access = [
        'permissions' => 'create-admins',
        'roles'       => ''
    ];


    protected $decode = [];

    protected $urlParameters = [];

    public function rules() {
        return [
            'phone'    => 'required|size:11|unique:users,phone',
            'password' => 'required|min:6|max:30',
            'name'     => 'min:2|max:50'
        ];
    }

    public function authorize() {
        return $this->check(['hasAccess']);
    }
}