<?php


namespace App\Containers\Tiku\Data\Repositories;


use Porto\Core\Abstracts\Repositories\CoreRepository;

class SubjectRepository extends CoreRepository
{
    protected $container = 'Tiku';

    protected $fieldSearchable = [
        'name' => 'like'
    ];
}