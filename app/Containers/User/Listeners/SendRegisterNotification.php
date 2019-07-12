<?php


namespace App\Containers\User\Listeners;


use App\Containers\User\Events\UserRegisteredEvent;
use Illuminate\Support\Facades\Log;

class SendRegisterNotification
{
    // 手动访问队列
//    use InteractsWithQueue;

//    /**
//     * 队列化任务使用的连接名称。
//     *
//     * @var string|null
//     */
//    public $connection = 'sqs';
//
//    /**
//     * 队列化任务使用的队列名称。
//     *
//     * @var string|null
//     */
//    public $queue = 'listeners';

    /**
     * 处理事件
     *
     * @param UserRegisteredEvent $event
     */
    public function handle(UserRegisteredEvent $event) {
        Log::info('注册用户,ID=' . $event->user->id . ' | NAME= ' . $event->user->name);
    }

    /**
     * 处理失败
     *
     * @param UserRegisteredEvent $event
     * @param                     $exception
     */
    public function failed(UserRegisteredEvent $event, $exception) {

    }
}