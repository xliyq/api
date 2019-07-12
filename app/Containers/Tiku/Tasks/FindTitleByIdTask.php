<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\TitleRepository;
use App\Containers\Tiku\Models\Title;
use Porto\Core\Exceptions\NotFoundException;
use Porto\Core\Tasks\CoreTask;

class FindTitleByIdTask extends CoreTask
{
    protected $repository;

    public function __construct(TitleRepository $repository) {
        $this->repository = $repository;
    }


    public function run(int $titleId): Title {
        try {
            return $this->repository->find($titleId);
        } catch (\Exception $exception) {
            throw new NotFoundException();
        }
    }
}