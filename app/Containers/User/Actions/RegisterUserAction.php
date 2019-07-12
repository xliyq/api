<?php


namespace App\Containers\User\Actions;


use App\Containers\User\Events\UserRegisteredEvent;
use App\Containers\User\Models\User;
use App\Containers\User\Notifications\UserRegisteredNotification;
use Illuminate\Support\Facades\Notification;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class RegisterUserAction extends CoreAction
{
    public function run(DataDto $data): User {
        $user = Porto::call('User@CreateUserByCredentialsTask', [
            $data->phone,
            $data->password,
            $data->name,
            $data->avatar_url
        ]);

        // 直接调用事件监听
//        App::make(Dispatcher::class)->dispatch(new UserRegisteredEvent($user));
        Notification::send($user, new UserRegisteredNotification($user));

        //分发事件
        event(new UserRegisteredEvent($user));

        return $user;
    }
}