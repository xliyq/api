<?php


namespace App\Containers\Tiku\UI\API\Resources;


use Porto\Core\Resources\CoreResource;

class KnowledgeResource extends CoreResource
{

    protected $defaultFields = [
        'id', 'name', 'pid', 'sort'
    ];

    protected $availableIncludes = [
        'children',
        'subject'
    ];

    public function includeChildren() {
        return KnowledgeResource::collection($this->children);
    }

    public function includeSubject() {
        return new SubjectResource($this->subject);
    }
}