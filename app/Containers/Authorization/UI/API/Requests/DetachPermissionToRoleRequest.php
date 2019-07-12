<?php


namespace App\Containers\Authorization\UI\API\Requests;


use Porto\Core\Requests\Request;

class DetachPermissionToRoleRequest extends Request
{

    public function rules() {
        return [
            'role_id'           => 'required|exists:roles,id',
            'permissions_ids'   => 'required',
            'permissions_ids.*' => 'exists:permissions,id'
        ];
    }
}