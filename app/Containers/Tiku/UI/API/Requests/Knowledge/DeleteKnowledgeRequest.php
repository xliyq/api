<?php


namespace App\Containers\Tiku\UI\API\Requests\Knowledge;


use Porto\Core\Requests\Request;

class DeleteKnowledgeRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    protected $urlParameters = [
        'id',
    ];

    public function rules() {
        return [
            'id' => 'required|exists:knowledge,id',
        ];
    }
}