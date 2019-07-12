<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\SubjectRepository;
use App\Containers\Tiku\Models\Subject;
use Porto\Core\Exceptions\NotFoundException;
use Porto\Core\Tasks\CoreTask;

class FindSubjectByIdTask extends CoreTask
{
    protected $repository;

    public function __construct(SubjectRepository $repository) {
        $this->repository = $repository;
    }

    public function run(int $subjectId): Subject {
        try {
            return $this->repository->find($subjectId);
        } catch (\Exception $exception) {
            throw new NotFoundException();
        }
    }
}