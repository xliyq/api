<?php


namespace App\Containers\User\Events;


use App\Containers\User\Models\User;
use Porto\Core\Events\CoreEvent;

/**
 * Class UserRegisteredEvent
 * 用户注册事件
 *
 * @package App\Containers\User\Events
 *
 * author liyq <2847895875@qq.com>
 */
class UserRegisteredEvent extends CoreEvent
{

    /**
     * @var User
     */
    public $user;

    public function __construct(User $user) {
        $this->user = $user;
    }
}