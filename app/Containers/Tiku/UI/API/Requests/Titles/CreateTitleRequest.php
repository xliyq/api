<?php


namespace App\Containers\Tiku\UI\API\Requests\Titles;


use Porto\Core\Requests\Request;

class CreateTitleRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function rules() {
        return [
            'content'            => 'required',
            'analysis'           => 'required',
            'answers'            => 'required|array',
            'subject_id'         => 'required|exists:subjects,id',
            'grade_id'           => 'required|exists:grades,id',
            'type_id'            => 'required|exists:title_types,id',
            'options'            => 'array',
            'options.*.content'  => 'string',
            'options.*.is_right' => 'boolean',
            'knowledge'          => 'required|array',
            'knowledge.*'        => 'required|exists:knowledge,id',
        ];
    }
}