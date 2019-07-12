<?php


namespace App\Containers\Tiku\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class GetAllSubjectsAction extends CoreAction
{
    public function run(DataDto $dto) {
        $subjects = Porto::call('Tiku@GetAllSubjectsTask');

        return $subjects;
    }
}