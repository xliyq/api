<?php


namespace App\Containers\Tiku\UI\API\Requests\Titles;


use Porto\Core\Requests\Request;

class UpdateTitleRequest extends Request
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
            'id'                 => 'required|exists:titles,id',
            'content'            => 'string',
            'analysis'           => 'string',
            'answers'            => 'array',
            'subject_id'         => 'exists:subjects,id',
            'grade_id'           => 'exists:grades,id',
            'type_id'            => 'exists:title_types,id',
            'options'            => 'array',
            'options.*.id'       => 'exists:title_options,id',
            'options.*.content'  => 'string',
            'options.*.is_right' => 'boolean',
            'knowledge'          => 'array',
            'knowledge.*'        => 'exists:knowledge,id',
        ];
    }
}