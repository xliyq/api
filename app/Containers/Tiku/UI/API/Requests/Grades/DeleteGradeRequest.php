<?php


namespace App\Containers\Tiku\UI\API\Requests\Grades;


use Porto\Core\Requests\Request;

class DeleteGradeRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    protected $urlParameters = [
        'id'
    ];

    public function rules() {
        return [
            'id' => 'required|exists:grades,id'
        ];
    }
}