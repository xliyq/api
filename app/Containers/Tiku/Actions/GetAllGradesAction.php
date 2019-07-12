<?php


namespace App\Containers\Tiku\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class GetAllGradesAction extends CoreAction
{
    public function run(DataDto $dto) {
        return Porto::call('Tiku@GetAllGradesTask',[],[]);
    }
}