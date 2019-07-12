<?php


namespace App\Containers\Authorization\Tasks;


use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\Authorization\Models\Permission;
use Porto\Core\Exceptions\CreateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

/**
 * Class CreatePermissionTask
 *
 * 创建Permission
 *
 * @package App\Containers\Authorization\Tasks
 *
 * author liyq <2847895875@qq.com>
 */
class CreatePermissionTask extends CoreTask
{
    protected $repository;

    public function __construct(PermissionRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param string      $name
     * @param string|null $description
     * @param string|null $displayName
     *
     * @return Permission
     */
    public function run(string $name, string $displayName = null, string $description = null): Permission {
        app()['cache']->forget('spatie.permission.cache');
        try {
            $permission = $this->repository->create([
                'name' => $name,
                'description' => $description,
                'display_name' => $displayName,
                'guard_name' => 'web',
            ]);
            return $permission;
        } catch
        (\Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}