<?php

namespace App\Containers\Authentication\Data\Repositories;

use Porto\Core\Abstracts\Repositories\CoreRepository;

/**
 * Class AuthenticationRepository
 */
class AuthenticationRepository extends CoreRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
