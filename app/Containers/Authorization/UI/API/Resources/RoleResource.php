<?php


namespace App\Containers\Authorization\UI\API\Resources;


use Porto\Core\Resources\CoreResource;

class RoleResource extends CoreResource
{
    protected $defaultFields = ['id', 'name'];

    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [
        'permissions'
    ];


    public function includePermissions() {
        return PermissionResource::collection($this->permissions);
    }
}