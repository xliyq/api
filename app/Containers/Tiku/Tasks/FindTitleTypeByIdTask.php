<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\TitleTypeRepository;
use App\Containers\Tiku\Models\TitleType;
use Porto\Core\Exceptions\NotFoundException;
use Porto\Core\Tasks\CoreTask;

class FindTitleTypeByIdTask extends CoreTask
{
    protected $repository;

    public function __construct(TitleTypeRepository $repository) {
        $this->repository = $repository;
    }

    public function run(int $titleTypeId): TitleType {
        try {
            return $this->repository->find($titleTypeId);
        } catch (\Exception $exception) {
            throw  new NotFoundException();
        }
    }
}