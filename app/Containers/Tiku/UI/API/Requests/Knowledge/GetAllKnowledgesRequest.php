<?php


namespace App\Containers\Tiku\UI\API\Requests\Knowledge;


use Porto\Core\Requests\Request;

class GetAllKnowledgesRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function rules() {
        return [
            'subject_id' => 'required|exists:subjects,id'
        ];
    }
}