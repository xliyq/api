<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\SubjectRepository;
use Porto\Core\Tasks\CoreTask;

class GetAllSubjectsTask extends CoreTask
{
    protected $repository;

    public function __construct(SubjectRepository $repository) {
        $this->repository = $repository;
    }

    public function run() {
        return $this->repository->paginate();
    }
}