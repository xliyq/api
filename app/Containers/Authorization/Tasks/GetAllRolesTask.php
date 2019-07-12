<?php


namespace App\Containers\Authorization\Tasks;


use App\Containers\Authorization\Data\Repositories\RoleRepository;
use Porto\Core\Tasks\CoreTask;

/**
 * Class GetAllRolesTask
 *
 * 获取所有的Role
 *
 * @package App\Containers\Authorization\Tasks
 *
 * author liyq <2847895875@qq.com>
 */
class GetAllRolesTask extends CoreTask
{
    protected $repository;

    public function __construct(RoleRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function run() {
        return  $this->repository->paginate();
    }
}