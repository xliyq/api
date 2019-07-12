<?php


namespace App\Ship\Providers;


use Barryvdh\Debugbar\Facade;
use Liyq\Laravel\Notifications\JPush\JPushServiceProvider;
use Liyq\Laravel\Notifications\SMS\SmsServiceProvider;
use Porto\Core\Providers\Abstracts\CoreMainProvider;
use Porto\Core\Providers\CoreProvider;

class ShipServiceProvider extends CoreMainProvider
{
    public $serviceProviders = [
        CoreProvider::class,
        BroadcastServiceProvider::class,
        \Sentry\Laravel\ServiceProvider::class,
        JPushServiceProvider::class,
        SmsServiceProvider::class,
    ];

    protected $aliases = [
        'Debugbar' => Facade::class,
        'sentry'   => \Sentry\Laravel\Facade::class
    ];

    public function boot() {
        parent::boot();
//        $this->mergeConfigFrom(__DIR__ . '/../Configs/optimus.heimdal.php', 'optimus.heimdal');
    }

    public function register() {

        if ($this->app->environment() !== 'production') {
            // ide-helper
        }
        parent::register();

    }
}