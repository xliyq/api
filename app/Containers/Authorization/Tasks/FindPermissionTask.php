<?php


namespace App\Containers\Authorization\Tasks;


use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\Authorization\Models\Permission;
use Porto\Core\Tasks\CoreTask;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class FindPermissionTask
 *
 * 查找Permission
 *
 * @package App\Containers\Authorization\Tasks
 *
 * author liyq <2847895875@qq.com>
 */
class FindPermissionTask extends CoreTask
{
    protected $repository;

    public function __construct(PermissionRepository $repository) {
        $this->repository = $repository;
    }

    public function run($permissionNameOrId): Permission {
        $query = is_numeric($permissionNameOrId) ? ['id' => $permissionNameOrId] : ['name' => $permissionNameOrId];
        try {
            $permission = $this->repository->findWhere($query)->first();
        } catch (\Exception $exception) {
            throw new NotFoundResourceException();
        }
        return $permission;
    }
}