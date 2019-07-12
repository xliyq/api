<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\GradeRepository;
use App\Containers\Tiku\Models\Grade;
use Porto\Core\Exceptions\NotFoundException;
use Porto\Core\Tasks\CoreTask;

class FindGradeByIdTask extends CoreTask
{
    protected $repository;

    public function __construct(GradeRepository $repository) {
        $this->repository = $repository;
    }

    public function run(int $gradeId): Grade {
        try {
            return $this->repository->find($gradeId);
        } catch (\Exception $e) {
            throw new NotFoundException();
        }
    }
}