<?php

namespace App\Containers\Authorization\Actions;

use Porto\Core\Actions\CoreAction;
use Apiato\Core\Foundation\Facades\Apiato;
use Porto\Core\Support\Facades\Porto;

class GetAllPermissionsAction extends CoreAction
{
    public function run() {
        $permissions = Porto::call('Authorization@GetAllPermissionsTask', [], [
            'addRequestCriteria'
        ]);

        return $permissions;
    }
}
