<?php


namespace App\Containers\User\Data\Criterias;


use Porto\Core\Criterias\CoreCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

class RoleCriteria extends CoreCriteria
{

    private $roles;

    public function __construct($roles) {
        $this->roles = $roles;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository) {
        return $model->whereHas('roles', function ($query) {
            $query->where('name', $this->roles);
        });
    }
}