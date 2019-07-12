<?php


namespace App\Containers\Tiku\UI\API\Requests\Knowledge;


use Porto\Core\Requests\Request;

class UpdateKnowledgeRequest extends Request
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
            'id'   => 'required|exists:knowledge,id',
            'name' => 'required|max:50',
            'pid'  => 'integer',
            'sort' => 'integer'
        ];
    }
}