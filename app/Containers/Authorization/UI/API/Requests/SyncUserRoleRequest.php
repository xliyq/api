<?php


namespace App\Containers\Authorization\UI\API\Requests;


use Porto\Core\Requests\Request;

class SyncUserRoleRequest extends Request
{

    public function rules() {
        return [
            'roles_ids'   => 'required|array',
            'roles_ids.*' => 'exists:roles,id',
            'user_id'     => 'required|exists:users,id'
        ];
    }
}