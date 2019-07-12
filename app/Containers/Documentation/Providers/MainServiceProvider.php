<?php


namespace App\Containers\Documentation\Providers;

use Porto\Core\Providers\Abstracts\CoreMainProvider;

class MainServiceProvider extends CoreMainProvider
{
    public $serviceProviders = [
    ];

    public $aliases = [];

    public function boot() {
        parent::boot();
        $this->loadViewsFrom(__DIR__ . '/../Template/', 'documentation');
    }
}