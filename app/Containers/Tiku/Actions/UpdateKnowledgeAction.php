<?php


namespace App\Containers\Tiku\Actions;


use App\Containers\Tiku\Models\Knowledge;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class UpdateKnowledgeAction extends CoreAction
{
    public function run(DataDto $dto): Knowledge {
        $knowledge = $dto->sanitizeInput([
            'name',
            'sort'
        ]);

        return Porto::call('Tiku@UpdateKnowledgeTask', [$knowledge, $dto->id]);
    }
}