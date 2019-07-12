<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\KnowledgeRepository;
use App\Containers\Tiku\Models\Knowledge;
use Porto\Core\Exceptions\NotFoundException;
use Porto\Core\Tasks\CoreTask;

class FindKnowledgeByIdTask extends CoreTask
{
    protected $repository;

    public function __construct(KnowledgeRepository $repository) {
        $this->repository = $repository;
    }

    public function run(int $knowledgeId): Knowledge {
        try {
            return $this->repository->find($knowledgeId);
        } catch (\Exception $exception) {
            throw  new NotFoundException();
        }
    }
}