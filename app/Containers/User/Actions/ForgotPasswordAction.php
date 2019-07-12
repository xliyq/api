<?php


namespace App\Containers\User\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Support\Facades\Porto;

class ForgotPasswordAction extends CoreAction
{
    public function run($data) {
        $user = Porto::call('User@FindUserByPhoneTask', [$data->phone]);
        if ($user) {
            $token = Porto::call('User@CreatePasswordResetTask', [$user]);
        }

    }
}