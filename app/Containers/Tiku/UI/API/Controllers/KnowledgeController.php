<?php


namespace App\Containers\Tiku\UI\API\Controllers;


use App\Containers\Tiku\UI\API\Requests\Knowledge\CreateKnowledgeRequest;
use App\Containers\Tiku\UI\API\Requests\Knowledge\DeleteKnowledgeRequest;
use App\Containers\Tiku\UI\API\Requests\Knowledge\FindKnowledgeByIdRequest;
use App\Containers\Tiku\UI\API\Requests\Knowledge\GetAllKnowledgesRequest;
use App\Containers\Tiku\UI\API\Requests\Knowledge\UpdateKnowledgeRequest;
use App\Containers\Tiku\UI\API\Resources\KnowledgeResource;
use Porto\Core\Http\Controllers\ApiController;
use Porto\Core\Support\Facades\Porto;

class KnowledgeController extends ApiController
{

    /**
     * 创建知识点
     *
     * @param CreateKnowledgeRequest $request
     *
     * @return KnowledgeResource
     */
    public function createKnowledge(CreateKnowledgeRequest $request) {
        $knowledge = Porto::call('Tiku@CreateKnowledgeAction', [$request]);

        return new KnowledgeResource($knowledge);
    }

    /**
     * 删除知识点
     *
     * @param DeleteKnowledgeRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteKnowledge(DeleteKnowledgeRequest $request) {
        Porto::call('Tiku@DeleteKnowledgeAction', [$request]);

        return $this->noContent();
    }

    /**
     * 更新知识点
     *
     * @param UpdateKnowledgeRequest $request
     *
     * @return KnowledgeResource
     */
    public function updateKnowledge(UpdateKnowledgeRequest $request) {
        $knowledge = Porto::call('Tiku@UpdateKnowledgeAction', [$request]);

        return new KnowledgeResource($knowledge);
    }


    /**
     * 查询所有知识点
     *
     * @param GetAllKnowledgesRequest $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed
     */
    public function getAllKnowledge(GetAllKnowledgesRequest $request) {
        $list = Porto::call('Tiku@GetAllKnowledgesAction', [$request]);

        return KnowledgeResource::collection($list);
    }

    /**
     * 根据ID获取知识点
     *
     * @param FindKnowledgeByIdRequest $request
     *
     * @return KnowledgeResource
     */
    public function findKnowledgeById(FindKnowledgeByIdRequest $request) {
        $knowledge = Porto::call('Tiku@FindKnowledgeByIdAction', [$request]);

        return new KnowledgeResource($knowledge);
    }
}