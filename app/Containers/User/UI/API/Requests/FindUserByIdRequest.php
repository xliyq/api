<?php


namespace App\Containers\User\UI\API\Requests;


use Porto\Core\Requests\Request;

class FindUserByIdRequest extends Request
{
    protected $urlParameters = [
        'id',
    ];

    public function rules() {
        return [
            'id' => 'required|exists:users,id'
        ];
    }

    public function authorize() {
        return $this->check([
            'hasAccess|isOwner'
        ]);
    }
}