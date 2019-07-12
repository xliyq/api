<?php


namespace App\Containers\Tiku\Actions;


use App\Containers\Tiku\Models\Grade;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class UpdateGradeAction extends CoreAction
{
    public function run(DataDto $dto): Grade {
        $data = $dto->sanitizeInput(['name']);
        return Porto::call('Tiku@UpdateGradeTask', [$data, $dto->id]);
    }
}