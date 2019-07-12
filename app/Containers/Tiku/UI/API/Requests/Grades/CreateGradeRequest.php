<?php


namespace App\Containers\Tiku\UI\API\Requests\Grades;


use Porto\Core\Requests\Request;

class CreateGradeRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function rules() {
        return [
            'name' => 'required|max:50'
        ];
    }
}