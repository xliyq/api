<?php


namespace App\Containers\Tiku\UI\API\Requests\Knowledge;


use Porto\Core\Requests\Request;

class CreateKnowledgeRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function rules() {
        return [
            'name'       => 'required|max:50',
            'subject_id' => 'required|exists:subjects,id',
            'pid'        => 'integer',
            'sort'       => 'integer',
        ];
    }
}