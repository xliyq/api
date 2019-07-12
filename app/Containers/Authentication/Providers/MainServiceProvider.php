<?php

namespace App\Containers\Authentication\Providers;

use Laravel\Passport\PassportServiceProvider;
use Porto\Core\Providers\Abstracts\CoreMainProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 *
 * @author liyq <2847895875@qq.com>
 */
class MainServiceProvider extends CoreMainProvider
{

    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        PassportServiceProvider::class,
        AuthServiceProvider::class
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        // 'Foo' => Bar::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register() {
        parent::register();

        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        // ...
    }
}
