<?php


namespace App\Containers\Tiku\UI\API\Resources;


use Porto\Core\Resources\CoreResource;

class GradeResource extends CoreResource
{
    protected $defaultFields = [
        'id', 'name'
    ];
}