<?php


namespace App\Containers\Tiku\Actions;


use App\Containers\Tiku\Models\Subject;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class UpdateSubjectAction extends CoreAction
{
    public function run(DataDto $dto): Subject {

        $data = $dto->sanitizeInput(['name']);

        $subject = Porto::call('Tiku@UpdateSubjectTask', [$data, $dto->id]);

        return $subject;
    }

}