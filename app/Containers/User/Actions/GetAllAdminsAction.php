<?php


namespace App\Containers\User\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Support\Facades\Porto;

class GetAllAdminsAction extends CoreAction
{
    public function run() {
        return Porto::call('User@GetAllUsersTask',
            [],
            [
                'addRequestCriteria',
                'admins',
                'ordered',
            ]
        );
    }
}