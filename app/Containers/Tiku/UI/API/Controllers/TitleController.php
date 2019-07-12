<?php


namespace App\Containers\Tiku\UI\API\Controllers;


use App\Containers\Tiku\UI\API\Requests\Titles\CreateTitleRequest;
use App\Containers\Tiku\UI\API\Requests\Titles\DeleteTitleRequest;
use App\Containers\Tiku\UI\API\Requests\Titles\FindTitleByIdRequest;
use App\Containers\Tiku\UI\API\Requests\Titles\GetAllTitlesRequest;
use App\Containers\Tiku\UI\API\Requests\Titles\UpdateTitleRequest;
use App\Containers\Tiku\UI\API\Resources\TitleResource;
use Porto\Core\Http\Controllers\ApiController;
use Porto\Core\Support\Facades\Porto;

class TitleController extends ApiController
{
    public function createTitle(CreateTitleRequest $request) {
        $title = Porto::call('Tiku@CreateTitleAction', [$request]);

        return new TitleResource($title);
    }

    public function deleteTitle(DeleteTitleRequest $request) {
        Porto::call('Tiku@DeleteTitleAction', [$request]);

        return $this->noContent();
    }

    public function updateTitle(UpdateTitleRequest $request) {
        $title = Porto::call('Tiku@UpdateTitleAction', [$request]);

        return new TitleResource($title);
    }

    public function getAllTitles(GetAllTitlesRequest $request) {
        $titles = Porto::call('Tiku@GetAllTitlesAction', [$request]);

        return TitleResource::collection($titles);
    }

    public function findTitleById(FindTitleByIdRequest $request) {
        $title = Porto::call('Tiku@FindTitleByIdAction', [$request]);

        return new TitleResource($title);
    }
}