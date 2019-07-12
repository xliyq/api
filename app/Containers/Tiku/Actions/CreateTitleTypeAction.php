<?php


namespace App\Containers\Tiku\Actions;


use App\Containers\Tiku\Models\TitleType;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class CreateTitleTypeAction extends CoreAction
{
    public function run(DataDto $dto): TitleType {
        $data = $dto->sanitizeInput(['name', 'subject_id', 'support_online']);

        return Porto::call('Tiku@CreateTitleTypeTask', $data);
    }
}