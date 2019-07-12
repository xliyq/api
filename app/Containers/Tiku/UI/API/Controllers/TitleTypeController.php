<?php


namespace App\Containers\Tiku\UI\API\Controllers;


use App\Containers\Tiku\UI\API\Requests\TitleTypes\CreateTitleTypeRequest;
use App\Containers\Tiku\UI\API\Requests\TitleTypes\DeleteTitleTypeRequest;
use App\Containers\Tiku\UI\API\Requests\TitleTypes\FindTitleTypeByIdRequest;
use App\Containers\Tiku\UI\API\Requests\TitleTypes\GetAllTitleTypesRequest;
use App\Containers\Tiku\UI\API\Requests\TitleTypes\UpdateTitleTypeRequest;
use App\Containers\Tiku\UI\API\Resources\TitleTypeResource;
use Porto\Core\Http\Controllers\ApiController;
use Porto\Core\Support\Facades\Porto;

class TitleTypeController extends ApiController
{

    public function createTitleType(CreateTitleTypeRequest $request) {
        $type = Porto::call('Tiku@CreateTitleTypeAction', [$request]);

        return new TitleTypeResource($type);
    }

    public function deleteTitleType(DeleteTitleTypeRequest $request) {
        Porto::call('Tiku@DeleteTitleTypeAction', [$request]);

        return $this->noContent();
    }

    public function updateTitleType(UpdateTitleTypeRequest $request) {
        $type = Porto::call('Tiku@UpdateTitleTypeAction', [$request]);

        return new TitleTypeResource($type);
    }

    public function findTitleTypeById(FindTitleTypeByIdRequest $request) {
        $type = Porto::call('Tiku@FindTitleTypeByIdAction', [$request]);

        return new TitleTypeResource($type);
    }

    public function getAllTitleTypes(GetAllTitleTypesRequest $request) {
        $types = Porto::call('Tiku@GetAllTitleTypesAction', [$request]);

        return TitleTypeResource::collection($types);
    }
}