<?php


namespace App\Containers\Tiku\UI\API\Requests\Subjects;


use Porto\Core\Requests\Request;

class CreateSubjectRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];


    public function rules() {
        return [
            'name' => 'required|max:50',
        ];
    }
}