<?php


namespace App\Containers\User\Tasks;


use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use Exception;
use Porto\Core\Exceptions\NotFoundException;
use Porto\Core\Tasks\CoreTask;

/**
 * Class FindUserByPhoneTask
 * 根据手机号查询用户
 *
 * @package App\Containers\User\Tasks
 *
 * author liyq <2847895875@qq.com>
 */
class FindUserByPhoneTask extends CoreTask
{
    protected $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function run(string $phone): User {
        try {
            $user = $this->repository->findByField('phone', $phone)->first();
            if ($user) {
                return $user;
            }
            throw new Exception();
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}