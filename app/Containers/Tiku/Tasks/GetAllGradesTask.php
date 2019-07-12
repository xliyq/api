<?php

namespace App\Containers\Tiku\Tasks;

use App\Containers\Tiku\Data\Repositories\GradeRepository;
use Porto\Core\Tasks\CoreTask;

class GetAllGradesTask extends CoreTask
{
    protected $repository;

    public function __construct(GradeRepository $repository) {
        $this->repository = $repository;
    }

    public function run() {
        return $this->repository->paginate();
    }
}
