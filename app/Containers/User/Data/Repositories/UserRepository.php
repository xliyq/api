<?php

namespace App\Containers\User\Data\Repositories;

use Porto\Core\Abstracts\Repositories\CoreRepository;

/**
 * Class UserRepository
 */
class UserRepository extends CoreRepository
{

    protected $container = 'User';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'  => 'like',
        'phone' => '='
    ];

}
