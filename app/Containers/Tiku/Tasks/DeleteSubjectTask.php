<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\SubjectRepository;
use Porto\Core\Exceptions\DeleteResourceFailedException;

class DeleteSubjectTask
{
    protected $repository;

    public function __construct(SubjectRepository $repository) {
        $this->repository = $repository;
    }

    public function run(int $subjectId) {
        try {
            return $this->repository->delete($subjectId);
        } catch (\Exception $e) {
            throw new DeleteResourceFailedException();
        }
    }
}