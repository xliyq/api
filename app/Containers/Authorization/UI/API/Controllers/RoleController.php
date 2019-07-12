<?php


namespace App\Containers\Authorization\UI\API\Controllers;


use App\Containers\Authorization\UI\API\Requests\AssignUserToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Containers\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Containers\Authorization\UI\API\Requests\FindRoleRequest;
use App\Containers\Authorization\UI\API\Requests\GetAllRolesRequest;
use App\Containers\Authorization\UI\API\Requests\RevokeRoleFromUserRequest;
use App\Containers\Authorization\UI\API\Requests\SyncUserRoleRequest;
use App\Containers\Authorization\UI\API\Resources\RoleResource;
use App\Containers\User\UI\API\Resources\UserResource;
use Porto\Core\Http\Controllers\ApiController;
use Porto\Core\Support\Facades\Porto;

class RoleController extends ApiController
{

    /**
     * 创建Role
     *
     * @param CreateRoleRequest $request
     *
     * @return RoleResource
     */
    public function createRole(CreateRoleRequest $request) {
        $role = Porto::call('Authorization@CreateRoleAction', [$request]);

        return new RoleResource($role);
    }

    /**
     * 查找Role
     *
     * @param GetAllRolesRequest $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed
     */
    public function getAllRoles(GetAllRolesRequest $request) {
        $roles = Porto::call('Authorization@GetAllRolesAction');

        return RoleResource::collection($roles);
    }

    /**
     * 根据ID查找Role
     *
     * @param FindRoleRequest $request
     *
     * @return RoleResource
     */
    public function findRole(FindRoleRequest $request) {
        $role = Porto::call('Authorization@FindRoleAction', [$request]);

        return new RoleResource($role);
    }

    /**
     * 给用户分配Role
     *
     * @param AssignUserToRoleRequest $request
     *
     * @return UserResource
     */
    public function assignUserToRole(AssignUserToRoleRequest $request) {
        $user = Porto::call('Authorization@AssignUserToRoleAction', [$request]);

        return new UserResource($user);
    }

    public function revokeRoleFromUser(RevokeRoleFromUserRequest $request) {
        $user = Porto::call('Authorization@RevokeRoleFromUserAction', [$request]);
        return new UserResource($user);
    }


    public function deleteRole(DeleteRoleRequest $request) {
        Porto::call('Authorization@DeleteRoleAction', [$request]);

        return $this->noContent();
    }

    public function syncUserRoles(SyncUserRoleRequest $request) {
        $user = Porto::call('Authorization@SyncUserRoleAction', [$request]);

        return new UserResource($user);
    }
}