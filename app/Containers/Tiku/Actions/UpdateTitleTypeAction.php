<?php


namespace App\Containers\Tiku\Actions;


use App\Containers\Tiku\Models\TitleType;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class UpdateTitleTypeAction extends CoreAction
{
    public function run(DataDto $dto): TitleType {

        $data = $dto->sanitizeInput(['name', 'support_online']);

        $titleType = Porto::call('Tiku@UpdateTitleTypeTask', [$data, $dto->id]);

        return $titleType;
    }

}