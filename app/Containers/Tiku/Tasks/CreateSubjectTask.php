<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\SubjectRepository;
use App\Containers\Tiku\Models\Subject;
use Porto\Core\Exceptions\CreateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class CreateSubjectTask extends CoreTask
{
    protected $repository;

    public function __construct(SubjectRepository $repository) {
        $this->repository = $repository;
    }

    public function run(string $name): Subject {
        try {
            return $this->repository->create([
                'name' => $name,
            ]);
        } catch (\Exception $exception) {
            throw  new CreateResourceFailedException();
        }
    }
}