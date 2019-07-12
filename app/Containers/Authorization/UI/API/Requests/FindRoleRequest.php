<?php


namespace App\Containers\Authorization\UI\API\Requests;


use Porto\Core\Requests\Request;

class FindRoleRequest extends Request
{

    protected $urlParameters = [
        'id',
    ];

    public function rules() {
        return [
            'id' => 'required|exists:roles,id'
        ];
    }
}