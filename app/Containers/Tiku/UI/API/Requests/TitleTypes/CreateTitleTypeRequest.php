<?php


namespace App\Containers\Tiku\UI\API\Requests\TitleTypes;


use Porto\Core\Requests\Request;

class CreateTitleTypeRequest extends Request
{
    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function rules() {
        return [
            'subject_id'     => 'required|exists:subjects,id',
            'name'           => 'required|max:50',
            'support_online' => 'boolean',
        ];
    }
}