<?php


namespace App\Containers\Tiku\Actions;


use App\Containers\Tiku\Models\Knowledge;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class CreateKnowledgeAction extends CoreAction
{
    public function run(DataDto $dto): Knowledge {
        return Porto::call('Tiku@CreateKnowledgeTask', [
            $dto->subject_id,
            $dto->name,
            $dto->pid ?? 0,
            $dto->sort ?? 50
        ]);
    }
}