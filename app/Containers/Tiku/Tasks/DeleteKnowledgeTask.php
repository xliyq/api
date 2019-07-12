<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\KnowledgeRepository;
use App\Containers\Tiku\Models\Knowledge;
use Porto\Core\Exceptions\DeleteResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class DeleteKnowledgeTask extends CoreTask
{
    public function run(Knowledge $knowledge) {
        if (count($knowledge->children)) {
            throw new DeleteResourceFailedException('知识点子集还存在数据');
        }

        try {
            $knowledge->delete();
        } catch (\Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}