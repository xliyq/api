<?php


namespace App\Containers\Tiku\UI\API\Requests\Grades;


use Porto\Core\Requests\Request;

class GetAllGradesRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function rules() {
        return [];
    }
}