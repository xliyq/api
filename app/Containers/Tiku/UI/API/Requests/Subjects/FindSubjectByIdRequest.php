<?php


namespace App\Containers\Tiku\UI\API\Requests\Subjects;


use Porto\Core\Requests\Request;

class FindSubjectByIdRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    protected $urlParameters = [
        'id',
    ];

    public function rules() {
        return [
            'id' => 'required|exists:subjects,id',
        ];
    }
}