<?php


namespace App\Containers\User\Tasks;


use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use Porto\Core\Exceptions\DeleteResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class DeleteUserTask extends CoreTask
{
    protected $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * 删除用户
     *
     * @param User $user
     *
     * @return bool
     */
    public function run(User $user) {
        try {
            return $this->repository->delete($user->id);
        } catch (\Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}