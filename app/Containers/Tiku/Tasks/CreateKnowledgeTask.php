<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\KnowledgeRepository;
use App\Containers\Tiku\Models\Knowledge;
use Porto\Core\Exceptions\CreateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class CreateKnowledgeTask extends CoreTask
{
    protected $repository;

    public function __construct(KnowledgeRepository $repository) {
        $this->repository = $repository;
    }

    public function run(int $subjectId, string $name, int $pid = 0, int $sort = 50): Knowledge {
        try {
            return $this->repository->create([
                'subject_id' => $subjectId,
                'name'       => $name,
                'pid'        => $pid,
                'sort'       => $sort,
            ]);
        } catch (\Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}