<?php


namespace App\Containers\User\Tasks;


use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Porto\Core\Exceptions\CreateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

/**
 * Class CreateUserByCredentialsTask
 *
 * 创建用户
 *
 * @package App\Containers\User\Tasks
 *
 * author liyq <2847895875@qq.com>
 */
class CreateUserByCredentialsTask extends CoreTask
{
    private $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function run(
        string $phone,
        string $password,
        string $name,
        $avatar_url = null): User {
        try {
            return $this->repository->create([
                'password' => Hash::make($password),
                'phone'    => $phone,
                'name'     => $name,
//                'avatar_url' => $avatar_url
            ]);
        } catch (\Exception $exception) {
            throw (new CreateResourceFailedException())->debug($exception);
        }
    }
}