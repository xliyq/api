<?php

namespace App\Containers\Authorization\Data\Repositories;

use Porto\Core\Abstracts\Repositories\CoreRepository;

/**
 * Class RoleRepository
 */
class RoleRepository extends CoreRepository
{
    protected $container = 'Authorization';
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => '=',
        'display_name' => '=',
    ];

}
