<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\TitleTypeRepository;
use App\Containers\Tiku\Models\TitleType;
use Porto\Core\Exceptions\DeleteResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class DeleteTitleTypeTask extends CoreTask
{

    public function run(TitleType $type) {
        try {
            return $type->delete();
        } catch (\Exception $exception) {
            throw new  DeleteResourceFailedException();
        }
    }
}