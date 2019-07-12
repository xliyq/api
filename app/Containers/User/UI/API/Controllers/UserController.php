<?php


namespace App\Containers\User\UI\API\Controllers;


use App\Containers\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\User\UI\API\Requests\ForgotPasswordRequest;
use App\Containers\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\User\UI\API\Requests\RegisterUserRequest;
use App\Containers\User\UI\API\Requests\ResetPasswordRequest;
use App\Containers\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\User\UI\API\Resources\UserResource;
use Illuminate\Support\Facades\Log;
use Porto\Core\Http\Controllers\ApiController;
use Porto\Core\Support\Facades\Porto;

class UserController extends ApiController
{
    public function registerUser(RegisterUserRequest $request) {
        $user = Porto::call('User@RegisterUserAction', [$request]);

        return new UserResource($user);
    }

    /**
     * 获取所有用户
     *
     * @param GetAllUsersRequest $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllUsers(GetAllUsersRequest $request) {
        $users = Porto::call('User@GetAllUsersAction');

        return UserResource::collection($users);
    }


    /**
     * 获取所有管理员
     *
     * @param GetAllUsersRequest $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllAdmins(GetAllUsersRequest $request) {
        $users = Porto::call('User@GetAllAdminsAction');

        return UserResource::collection($users);
    }


    /**
     * 根据id查找用户
     *
     * @param FindUserByIdRequest $request
     *
     * @return UserResource
     */
    public function findUserById(FindUserByIdRequest $request) {
        $user = Porto::call('User@FindUserByIdAction', [$request]);

        return new UserResource($user);
    }

    /**
     * 获取当前登录者的信息
     *
     * @return UserResource
     */
    public function getAuthenticatedUser() {
        $user = Porto::call('User@GetAuthenticatedUserAction');

        return new UserResource($user);
    }

    /**
     * 更新用户
     *
     * @param UpdateUserRequest $request
     *
     * @return UserResource
     */
    public function updateUser(UpdateUserRequest $request) {
        $user = Porto::call('User@UpdateUserAction', [$request]);

        return new UserResource($user);
    }


    /**
     * 删除用户
     *
     * @param DeleteUserRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser(DeleteUserRequest $request) {
        Porto::call('User@DeleteUserAction', [$request]);

        return $this->noContent();
    }

    public function forgotPassword(ForgotPasswordRequest $request) {
        // @todo
        Porto::call('User@ForgotPasswordAction', [$request]);
        return $this->noContent();
    }

    /**
     * 重置密码
     *
     * @param ResetPasswordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request) {
        Porto::call('User@ResetPasswordAction', [$request]);

        return $this->noContent();
    }

    /**
     * 创建管理员
     *
     * @param CreateAdminRequest $request
     *
     * @return UserResource
     */
    public function createAdmin(CreateAdminRequest $request) {
        $user = Porto::call('User@CreateAdminAction', [$request]);

        return new UserResource($user);
    }


}