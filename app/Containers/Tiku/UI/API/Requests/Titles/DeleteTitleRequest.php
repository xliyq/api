<?php


namespace App\Containers\Tiku\UI\API\Requests\Titles;


use Porto\Core\Requests\Request;

class DeleteTitleRequest extends Request
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
            'id' => 'required|exists:titles,id'
        ];
    }
}