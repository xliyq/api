<?php

namespace App\Containers\Debugger\Providers;

use App\Containers\Debugger\Tasks\QueryDebuggerTask;
use Jenssegers\Agent\AgentServiceProvider;
use Jenssegers\Agent\Facades\Agent;
use Porto\Core\Providers\Abstracts\CoreMainProvider;
use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends CoreMainProvider
{

    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        AgentServiceProvider::class,
        DebugbarServiceProvider::class,
        MiddlewareServiceProvider::class,
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        'Agent' => Agent::class
    ];

    /**
     * Register anything in the container.
     */
    public function register() {
        parent::register();

//        (new QueryDebuggerTask())->run();
    }
}
