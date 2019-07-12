<?php


namespace App\Containers\Tiku\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class DeleteKnowledgeAction extends CoreAction
{
    public function run(DataDto $dto) {
        $knowledge = Porto::call('Tiku@FindKnowledgeByIdTask', [$dto->id]);
        
        Porto::call('Tiku@DeleteKnowledgeTask', [$knowledge]);
    }
}