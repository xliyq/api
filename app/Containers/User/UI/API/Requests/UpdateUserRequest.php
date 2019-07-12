<?php


namespace App\Containers\User\UI\API\Requests;


use Porto\Core\Requests\Request;

class UpdateUserRequest extends Request
{
    protected $urlParameters = [
        'id'
    ];

    protected $access = [
        'permissions' => 'update-users',
        'roles'       => '',
    ];

    public function rules() {
        return [
            'id'       => 'required|exists:users,id',
            'phone'    => 'size:11',
            'password' => 'min:6|max:30',
            'name'     => 'min:2|max:50'
        ];
    }

    public function authorize() {
        return $this->check([
            'hasAccess|isOwner',
        ]);
    }
}