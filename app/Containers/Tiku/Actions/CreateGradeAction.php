<?php

namespace App\Containers\Tiku\Actions;

use App\Containers\Tiku\Models\Grade;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class CreateGradeAction extends CoreAction
{
    public function run(DataDto $dto): Grade {
        return Porto::call('Tiku@CreateGradeTask', [
            $dto->name
        ]);
    }
}
