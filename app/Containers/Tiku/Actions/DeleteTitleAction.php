<?php


namespace App\Containers\Tiku\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class DeleteTitleAction extends CoreAction
{
    public function run(DataDto $dto) {
        $title = Porto::call('Tiku@FindTitleByIdTask', [$dto->id]);
        Porto::call('Tiku@DeleteTitleTask', [$title]);
    }
}