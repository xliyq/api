<?php


namespace App\Containers\Tiku\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class DeleteSubjectAction extends CoreAction
{
    public function run(DataDto $dto) {
        Porto::call('Tiku@DeleteSubjectTask', [$dto->id]);
    }
}