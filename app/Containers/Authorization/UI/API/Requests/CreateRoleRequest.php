<?php


namespace App\Containers\Authorization\UI\API\Requests;


use Porto\Core\Requests\Request;

class CreateRoleRequest extends Request
{
    public function rules() {
        return [
            'name'         => 'required|unique:roles,name|min:2|max:20|no_spaces',
            'description'  => 'max:255',
            'display_name' => 'required|max:100',
        ];
    }
}