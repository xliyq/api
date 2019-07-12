<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\GradeRepository;
use App\Containers\Tiku\Models\Grade;
use Porto\Core\Exceptions\CreateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class CreateGradeTask extends CoreTask
{
    protected $repository;

    public function __construct(GradeRepository $repository) {
        $this->repository = $repository;
    }

    public function run(string $name): Grade {
        try {
            return $this->repository->create([
                'name' => $name
            ]);
        } catch (\Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}