<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\GradeRepository;
use App\Containers\Tiku\Models\Grade;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Porto\Core\Exceptions\CoreInternalErrorException;
use Porto\Core\Exceptions\NotFoundException;
use Porto\Core\Exceptions\UpdateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class UpdateGradeTask extends CoreTask
{
    protected $repository;

    public function __construct(GradeRepository $repository) {
        $this->repository = $repository;
    }

    public function run($gradeData, int $gradeId): Grade {
        if (empty($gradeData)) {
            throw new UpdateResourceFailedException();
        }

        try {
            return $this->repository->update($gradeData, $gradeId);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException('年级未找到');
        } catch (\Exception $e) {
            throw new CoreInternalErrorException();
        }
    }

}