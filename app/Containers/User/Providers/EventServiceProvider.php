<?php


namespace App\Containers\User\Providers;


use Porto\Core\Providers\Abstracts\CoreEventsProvider;

class EventServiceProvider extends CoreEventsProvider
{
    protected $listen = [
        'App\Containers\User\Events\UserRegisteredEvent' => [
            'App\Containers\User\Listeners\SendRegisterNotification'
        ]
    ];
}