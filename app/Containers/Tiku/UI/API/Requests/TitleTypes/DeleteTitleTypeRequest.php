<?php


namespace App\Containers\Tiku\UI\API\Requests\TitleTypes;


use Porto\Core\Requests\Request;

class DeleteTitleTypeRequest extends Request
{

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    protected $urlParameters = [
        'id',
    ];

    public function rules() {
        return [
            'id' => 'required|exists:title_types,id'
        ];
    }
}