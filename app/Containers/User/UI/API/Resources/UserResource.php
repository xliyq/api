<?php


namespace App\Containers\User\UI\API\Resources;


use App\Containers\Authorization\UI\API\Resources\RoleResource;
use Porto\Core\Resources\CoreResource;

class UserResource extends CoreResource
{

    protected $defaultFields = ['id', 'phone', 'name', 'created_at'];

    protected $availableIncludes = [
        'roles'
    ];

    protected $defaultIncludes = [

    ];

//    public function toArray($request) {
//        return [
//            'id'         => $this->id,
//            'name'       => $this->name,
//            'phone'      => $this->phone,
////            'avatar_url' => $this->avatar_url,
//            'roles'      => RoleResource::collection($this->roles),
//            'created_at' => (string)$this->created_at,
////            'updated_at' => (string)$this->updated_at
//        ];
//    }


    public function includeRoles() {
        return RoleResource::collection($this->roles);
    }

}