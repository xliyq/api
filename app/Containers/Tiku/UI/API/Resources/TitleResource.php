<?php


namespace App\Containers\Tiku\UI\API\Resources;


use Porto\Core\Resources\CoreResource;

class TitleResource extends CoreResource
{
    protected $defaultFields = ['id', 'content', 'analysis', 'answers', 'updated_at'];

    protected $defaultIncludes = [
        'options'
    ];

    protected $availableIncludes = [
        'attr',
        'knowledge'
    ];


    public function includeOptions() {
        return TitleOptionResource::collection($this->options);
    }

    public function includeAttr() {
        return new TitleAttrResource($this->attr);
    }

    public function includeKnowledge() {
        return KnowledgeResource::collection($this->knowledge);
    }

}