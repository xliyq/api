<?php


namespace App\Containers\User\Notifications;

use App\Containers\User\Models\User;
use Illuminate\Notifications\Notification as LaravelNotification;
use Liyq\Laravel\Notifications\JPush\JPushMessage;
use Liyq\Laravel\Notifications\SMS\SmsMessage;

class UserRegisteredNotification extends LaravelNotification
{
    const SMS_TEMPLATE_CODE = 'SMS_71470104';

    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function toSms($notifiable) {
        return SmsMessage::create(static::SMS_TEMPLATE_CODE, ['customer' => $this->user->name]);
    }

    public function toJpush($notifiable) {
        return (new JPushMessage())->setAlert('测试');
    }

    public function toDatabase($notifiable) {
        return [
            'customer'     => $this->user->name,
            'templateCode' => static::SMS_TEMPLATE_CODE
        ];
    }

    public function via($notifiable) {
        return [
            'database', 'sms', 'jpush'
        ];
    }
}