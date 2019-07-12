<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\SubjectRepository;
use App\Containers\Tiku\Models\Subject;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Porto\Core\Exceptions\UpdateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class UpdateSubjectTask extends CoreTask
{
    protected $repository;

    public function __construct(SubjectRepository $repository) {
        $this->repository = $repository;
    }

    public function run($subjectData, int $subjectId): Subject {
        if (empty($subjectData)) {
            throw new UpdateResourceFailedException();
        }
        try {
            return $this->repository->update($subjectData, $subjectId);
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException();
        } catch (\Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }

}