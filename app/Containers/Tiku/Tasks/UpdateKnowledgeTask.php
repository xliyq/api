<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\KnowledgeRepository;
use App\Containers\Tiku\Models\Knowledge;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Porto\Core\Exceptions\UpdateResourceFailedException;

class UpdateKnowledgeTask
{
    protected $repository;

    public function __construct(KnowledgeRepository $repository) {
        $this->repository = $repository;
    }

    public function run($knowledgeData, int $knowledgeId): Knowledge {
        if (empty($knowledgeData)) {
            throw new UpdateResourceFailedException();
        }

        try {
            return $this->repository->update($knowledgeData, $knowledgeId);
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        } catch (\Exception $exception) {
            throw new UpdateResourceFailedException();
        }

    }

}