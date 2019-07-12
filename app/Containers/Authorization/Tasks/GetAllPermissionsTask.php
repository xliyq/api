<?php


namespace App\Containers\Authorization\Tasks;


use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use Porto\Core\Tasks\CoreTask;

/**
 * Class GetAllPermissionsTask
 * 获取所有的Permission
 *
 * @package App\Containers\Authorization\Tasks
 *
 * author liyq <2847895875@qq.com>
 */
class GetAllPermissionsTask extends CoreTask
{
    protected $repository;

    public function __construct(PermissionRepository $repository) {
        $this->repository = $repository;
    }

    public function run($skipPagination = false) {
        return $skipPagination ? $this->repository->all() : $this->repository->paginate();
    }
}