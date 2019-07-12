<?php


namespace App\Containers\Tiku\UI\API\Resources;


use App\Containers\Tiku\Models\TitleType;
use Porto\Core\Resources\CoreResource;

class TitleAttrResource extends CoreResource
{

    protected $availableIncludes = [
        'subject',
        'type',
        'grade'
    ];

    public function includeSubject() {
        return new SubjectResource($this->subject);
    }

    public function includeType() {
        return new TitleTypeResource($this->type);
    }

    public function includeGrade() {
        return new GradeResource($this->grade);
    }
}