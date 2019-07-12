<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\TitleTypeRepository;
use App\Containers\Tiku\Models\TitleType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Porto\Core\Exceptions\UpdateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class UpdateTitleTypeTask extends CoreTask
{
    protected $repository;

    public function __construct(TitleTypeRepository $repository) {
        $this->repository = $repository;
    }

    public function run($typeData, int $titleTypeId): TitleType {
        if (empty($typeData)) {
            throw new UpdateResourceFailedException();
        }
        try {
            return $this->repository->update($typeData, $titleTypeId);
        } catch (ModelNotFoundException $exception) {
            throw  new ModelNotFoundException();
        } catch (\Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}