<?php

namespace App\Containers\Authorization\Data\Repositories;

use Porto\Core\Abstracts\Repositories\CoreRepository;

/**
 * Class PermissionRepository
 */
class PermissionRepository extends CoreRepository
{

    protected $container = 'Authorization';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => '=',
        'display_name' => 'like',
    ];

}
