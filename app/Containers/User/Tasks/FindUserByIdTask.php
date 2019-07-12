<?php


namespace App\Containers\User\Tasks;


use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use Porto\Core\Exceptions\NotFoundException;
use Porto\Core\Tasks\CoreTask;

class FindUserByIdTask extends CoreTask
{
    private $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function run(int $userId): User {
        try {
            return $this->repository->find($userId);
        } catch (\Exception $exception) {
            throw  new NotFoundException();
        }
    }
}