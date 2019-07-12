<?php


namespace App\Containers\Authorization\UI\API\Requests;


use Porto\Core\Requests\Request;

class AttachPermissionToRoleRequest extends Request
{
    public function rules() {
        return [
            'permissions_ids'   => 'required',
            'permissions_ids.*' => 'exists:permissions,id',
            'role_id'           => 'required|exists:roles,id',
        ];
    }
}