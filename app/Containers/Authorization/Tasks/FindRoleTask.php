<?php


namespace App\Containers\Authorization\Tasks;


use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Authorization\Models\Role;
use Porto\Core\Tasks\CoreTask;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class FindPermissionTask
 *
 * 查找Role
 *
 * @package App\Containers\Authorization\Tasks
 *
 * author liyq <2847895875@qq.com>
 */
class FindRoleTask extends CoreTask
{
    protected $repository;

    public function __construct(RoleRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param $roleNameOrId
     *
     * @return Role
     */
    public function run($roleNameOrId): Role {
        $query = is_numeric($roleNameOrId) ? ['id' => $roleNameOrId] : ['name' => $roleNameOrId];
        try {
            $role = $this->repository->findWhere($query)->first();
        } catch (\Exception $exception) {
            throw new NotFoundResourceException();
        }

        return $role;
    }
}