<?php


namespace App\Containers\User\Tasks;


use App\Containers\User\Data\Criterias\AdminsCriteria;
use App\Containers\User\Data\Criterias\RoleCriteria;
use App\Containers\User\Data\Repositories\UserRepository;
use Porto\Core\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use Porto\Core\Tasks\CoreTask;

class GetAllUsersTask extends CoreTask
{
    protected $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function run() {
        return $this->repository->paginate();
    }

    /**
     * 管理员条件
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function admins() {
//        $this->repository->pushCriteria(new AdminsCriteria());
        $this->withRole('admin');
    }

    /**
     * 按照创建时间倒序排
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function ordered() {
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }

    /**
     * 角色条件
     *
     * @param $roles
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function withRole($roles) {
        $this->repository->pushCriteria(new RoleCriteria($roles));
    }
}