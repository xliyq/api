<?php


namespace App\Containers\Tiku\UI\API\Resources;


use Porto\Core\Resources\CoreResource;

class TitleTypeResource extends CoreResource
{
    protected $availableIncludes = ['subject'];

    protected $defaultFields = ['id', 'name'];

    public function includeSubject() {
        return new SubjectResource($this->subject);
    }
}