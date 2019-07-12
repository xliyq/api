<?php


namespace App\Containers\Tiku\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class GetAllTitleTypesAction extends CoreAction
{
    public function run(DataDto $dto) {
        $titleTypes = Porto::call('Tiku@GetAllTitleTypesTask', [$dto->subject_id]);

        return $titleTypes;
    }
}