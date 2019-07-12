<?php


namespace App\Containers\Tiku\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class DeleteTitleTypeAction extends CoreAction
{
    public function run(DataDto $dto) {
        $type = Porto::call('Tiku@FindTitleTypeByIdTask', [$dto->id]);
        Porto::call('Tiku@DeleteTitleTypeTask', [$type]);
    }
}