<?php


namespace App\Containers\Tiku\UI\API\Requests\TitleTypes;


use Porto\Core\Requests\Request;

class UpdateTitleTypeRequest extends Request
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
            'id'             => 'required|exists:title_types,id',
            'name'           => 'required|max:50',
            'support_online' => 'boolean'
        ];
    }
}