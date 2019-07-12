<?php


namespace App\Containers\User\Tasks;


use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Porto\Core\Exceptions\NotFoundException;
use Porto\Core\Exceptions\UpdateResourceFailedException;
use Porto\Core\Tasks\CoreTask;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class UpdateUserTask extends CoreTask
{
    protected $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function run($userData, int $userId): User {
        if (empty($userData)) {
            throw new UpdateResourceFailedException();
        }

        try {
            return $this->repository->update($userData, $userId);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException('用户未找到');
        } catch (\Exception $exception) {
            throw new InternalErrorException();
        }
    }
}