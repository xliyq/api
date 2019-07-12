<?php


namespace App\Containers\Authentication\Providers;


use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;
use Porto\Core\Loaders\RoutesLoaderTrait;
use Porto\Core\Providers\Abstracts\CoreAuthProvider;

class AuthServiceProvider extends CoreAuthProvider
{
    use RoutesLoaderTrait;

    protected $defer = true;

    protected $policies = [

    ];

    public function boot() {
        $this->registerPolicies();

        $this->registerPassport();
    }

    private function registerPassport() {

        Route::group(['prefix' => $this->getApiVersionPrefix('v1')], function () {
            Passport::routes();
        });

        // 是否开启隐式授权
        if (Config::get('porto.api.enabled-implicit-grant')) {
            Passport::enableImplicitGrant();
        }

        // 设置过期时间
        Passport::tokensExpireIn(Carbon::now()->addMinutes(Config::get('porto.api.expires-in')));
        Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(Config::get('porto.api.refresh-expires-in')));

    }
}