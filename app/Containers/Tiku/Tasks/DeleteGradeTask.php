<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\GradeRepository;
use Porto\Core\Exceptions\DeleteResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class DeleteGradeTask extends CoreTask
{
    protected $repository;

    public function __construct(GradeRepository $repository) {
        $this->repository = $repository;
    }

    public function run(int $gradeId) {
        try {
            return $this->repository->delete($gradeId);
        } catch (\Exception $e) {
            throw new DeleteResourceFailedException();
        }
    }
}