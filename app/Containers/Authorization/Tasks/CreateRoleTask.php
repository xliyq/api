<?php


namespace App\Containers\Authorization\Tasks;


use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Authorization\Models\Role;
use Porto\Core\Exceptions\CreateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

/**
 * Class CreateRoleTask
 *
 * 创建Role
 *
 * @package App\Containers\Authorization\Tasks
 *
 * author liyq <2847895875@qq.com>
 */
class CreateRoleTask extends CoreTask
{
    protected $repository;

    public function __construct(RoleRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param string      $name
     * @param string|null $description
     * @param string|null $displayName
     *
     * @return Role
     */
    public function run(string $name, string $displayName = null, string $description = null): Role {
        app()['cache']->forget('spaite.permission.cache');
        try {
            $role = $this->repository->create([
                'name' => strtolower($name),
                'display_name' => $displayName,
                'description' => $description,
                'guard_name' => 'web',
            ]);
            return $role;
        } catch (\Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}