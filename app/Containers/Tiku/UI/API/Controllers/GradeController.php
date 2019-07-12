<?php


namespace App\Containers\Tiku\UI\API\Controllers;


use App\Containers\Tiku\UI\API\Requests\Grades\CreateGradeRequest;
use App\Containers\Tiku\UI\API\Requests\Grades\DeleteGradeRequest;
use App\Containers\Tiku\UI\API\Requests\Grades\FindGradeByIdRequest;
use App\Containers\Tiku\UI\API\Requests\Grades\GetAllGradesRequest;
use App\Containers\Tiku\UI\API\Requests\Grades\UpdateGradeRequest;
use App\Containers\Tiku\UI\API\Resources\GradeResource;
use Porto\Core\Http\Controllers\ApiController;
use Porto\Core\Support\Facades\Porto;

class GradeController extends ApiController
{

    /**
     * 创建年级
     *
     * @param CreateGradeRequest $request
     *
     * @return GradeResource
     */
    public function createGrade(CreateGradeRequest $request) {
        $grade = Porto::call('Tiku@CreateGradeAction', [$request]);
        return new GradeResource($grade);
    }

    /**
     * 更新年级
     *
     * @param UpdateGradeRequest $request
     *
     * @return GradeResource
     */
    public function updateGrade(UpdateGradeRequest $request) {
        $grade = Porto::call('Tiku@UpdateGradeAction', [$request]);
        return new GradeResource($grade);
    }

    /**
     * 删除年级
     *
     * @param DeleteGradeRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteGrade(DeleteGradeRequest $request) {
        Porto::call('Tiku@DeleteGradeAction', [$request]);
        return $this->noContent();
    }


    /**
     * 获取所有年级
     *
     * @param GetAllGradesRequest $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed
     */
    public function getAllGrades(GetAllGradesRequest $request) {
        $data = Porto::call('Tiku@GetAllGradesAction', [$request]);

        return GradeResource::collection($data);
    }

    /**
     * 查找指定的年级
     *
     * @param FindGradeByIdRequest $request
     *
     * @return GradeResource
     */
    public function findGradeById(FindGradeByIdRequest $request) {
        $grade = Porto::call('Tiku@FindGradeByIdAction', [$request]);

        return new GradeResource($grade);
    }
}