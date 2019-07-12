<?php


namespace App\Containers\Tiku\UI\API\Requests\Titles;


use Porto\Core\Requests\Request;

class GetAllTitlesRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function rules() {
        return [
            'subject_id'   => 'required|exists:subjects,id',
            'grade_id'     => 'exists:grades,id',
            'type_id'      => 'exists:title_types,id',
            'knowledge_id' => 'exists:knowledge,id'
        ];
    }
}