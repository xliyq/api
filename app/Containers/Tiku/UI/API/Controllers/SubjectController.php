<?php


namespace App\Containers\Tiku\UI\API\Controllers;


use App\Containers\Tiku\UI\API\Requests\Subjects\CreateSubjectRequest;
use App\Containers\Tiku\UI\API\Requests\Subjects\DeleteSubjectRequest;
use App\Containers\Tiku\UI\API\Requests\Subjects\FindSubjectByIdRequest;
use App\Containers\Tiku\UI\API\Requests\Subjects\GetAllSubjectsRequest;
use App\Containers\Tiku\UI\API\Requests\Subjects\UpdateSubjectRequest;
use App\Containers\Tiku\UI\API\Resources\SubjectResource;
use Porto\Core\Http\Controllers\ApiController;
use Porto\Core\Support\Facades\Porto;

class SubjectController extends ApiController
{

    /**
     * 创建科目
     *
     * @param CreateSubjectRequest $request
     *
     * @return SubjectResource
     */
    public function createSubject(CreateSubjectRequest $request) {
        $subject = Porto::call('Tiku@CreateSubjectAction', [$request]);

        return new SubjectResource($subject);
    }

    public function deleteSubject(DeleteSubjectRequest $request) {
        Porto::call('Tiku@DeleteSubjectAction', [$request]);

        return $this->noContent();
    }

    public function updateSubject(UpdateSubjectRequest $request) {
        $subject = Porto::call('Tiku@UpdateSubjectAction', [$request]);

        return new SubjectResource($subject);
    }

    public function getAllSubjects(GetAllSubjectsRequest $request) {
        $subjects = Porto::call('Tiku@GetAllSubjectsAction', [$request]);

        return SubjectResource::collection($subjects);
    }

    public function findSubjectById(FindSubjectByIdRequest $request) {
        $subject = Porto::call('Tiku@FindSubjectByIdAction', [$request]);

        return new SubjectResource($subject);
    }
}