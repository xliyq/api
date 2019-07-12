<?php


namespace App\Containers\Authorization\Tasks;


use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Authorization\Models\Role;
use Porto\Core\Exceptions\DeleteResourceFailedException;
use Porto\Core\Tasks\CoreTask;

/**
 * Class DeleteRoleTask
 *
 * 删除Role
 *
 * @package App\Containers\Authorization\Tasks
 *
 * author liyq <2847895875@qq.com>
 */
class DeleteRoleTask extends CoreTask
{
    protected $repository;

    public function __construct(RoleRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param int|Role $role
     *
     * @return bool
     */
    public function run($role): bool {
        if ($role instanceof Role) {
            $role = $role->id;
        }
        try {
            return $this->repository->delete($role);
        } catch (\Exception $exception) {
            throw  new DeleteResourceFailedException();
        }
    }
}