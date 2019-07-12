<?php


namespace App\Containers\Tiku\UI\API\Requests\TitleTypes;


use Porto\Core\Requests\Request;

class GetAllTitleTypesRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function rules() {
        return [];
    }
}