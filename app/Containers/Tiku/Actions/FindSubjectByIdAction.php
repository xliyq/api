<?php


namespace App\Containers\Tiku\Actions;


use App\Containers\Tiku\Models\Subject;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class FindSubjectByIdAction extends CoreAction
{
    public function run(DataDto $dto): Subject {
        $subject = Porto::call('Tiku@FindSubjectByIdTask', [$dto->id]);

        return $subject;
    }
}