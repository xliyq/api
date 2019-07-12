<?php

namespace App\Containers\Tiku\Data\Repositories;

use Porto\Core\Abstracts\Repositories\CoreRepository;

/**
 * Class TikuRepository
 */
class TitleRepository extends CoreRepository
{
    protected $container = 'Tiku';
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
