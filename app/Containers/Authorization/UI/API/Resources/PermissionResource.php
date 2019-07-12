<?php


namespace App\Containers\Authorization\UI\API\Resources;


use Porto\Core\Resources\CoreResource;

class PermissionResource extends CoreResource
{
    protected $defaultIncludes = [];
    protected $availableIncludes = [];

    public function toArray($request) {
        return [
            'id'   => $this->id,
            'name' => $this->name
        ];
    }
}