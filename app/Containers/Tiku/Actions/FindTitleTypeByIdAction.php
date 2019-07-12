<?php


namespace App\Containers\Tiku\Actions;


use App\Containers\Tiku\Models\TitleType;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class FindTitleTypeByIdAction extends CoreAction
{
    public function run(DataDto $dto): TitleType {
        $titleType = Porto::call('Tiku@FindTitleTypeByIdTask', [$dto->id]);

        return $titleType;
    }
}