<?php


namespace App\Containers\Authorization\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class GetAllRolesAction extends CoreAction
{
    public function run() {
        $roles = Porto::call('Authorization@GetAllRolesTask', [], ['addRequestCriteria']);

        return $roles;
    }
}