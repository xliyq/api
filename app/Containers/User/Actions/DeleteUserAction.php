<?php


namespace App\Containers\User\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

/**
 * Class DeleteUserAction
 *  删除用户
 *
 * @package App\Containers\User\Actions
 *
 * author liyq <2847895875@qq.com>
 */
class DeleteUserAction extends CoreAction
{
    public function run(DataDto $data): void {
        $user = $data->id ? Porto::call('User@FindUserByIdTask', [$data->id])
            : Porto::call('Authentication@GetAuthenticatedUserTask');

        Porto::call('User@DeleteUserTask', [$user]);
    }
}