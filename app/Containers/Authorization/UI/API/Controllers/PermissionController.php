<?php


namespace App\Containers\Authorization\UI\API\Controllers;


use App\Containers\Authorization\UI\API\Requests\AttachPermissionToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\DetachPermissionToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Containers\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Containers\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Containers\Authorization\UI\API\Resources\PermissionResource;
use App\Containers\Authorization\UI\API\Resources\RoleResource;
use Porto\Core\Http\Controllers\ApiController;
use Porto\Core\Support\Facades\Porto;

class PermissionController extends ApiController
{

    /**
     * 获取所有权限
     *
     * @param GetAllPermissionsRequest $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllPermissions(GetAllPermissionsRequest $request) {
        $permissions = Porto::call('Authorization@GetAllPermissionsAction');

        return PermissionResource::collection($permissions);
    }

    /**
     * 根据id查找permission
     *
     * @param FindPermissionRequest $request
     *
     * @return PermissionResource
     */
    public function findPermission(FindPermissionRequest $request) {
        $permission = Porto::call('Authorization@FindPermissionAction', [$request]);

        return new PermissionResource($permission);
    }

    /**
     * 将Permission 附加到 Role
     *
     * @param AttachPermissionToRoleRequest $request
     *
     * @return RoleResource
     */
    public function attachPermissionToRole(AttachPermissionToRoleRequest $request) {
        $role = Porto::call('Authorization@AttachPermissionToRoleAction', [$request]);

        return new RoleResource($role);
    }

    /**
     * 将Permission 从Role中移除
     *
     * @param DetachPermissionToRoleRequest $request
     *
     * @return RoleResource
     */
    public function detachPermissionToRole(DetachPermissionToRoleRequest $request) {
        $role = Porto::call('Authorization@DetachPermissionToRoleAction', [$request]);

        return new RoleResource($role);
    }


    public function syncPermissionOnRole(SyncPermissionsOnRoleRequest $request) {
        $role = Porto::call('Authorization@SyncPermissionsOnRoleAction', [$request]);
        return new RoleResource($role);
    }
}