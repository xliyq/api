<?php


namespace App\Ship\Providers;


use Illuminate\Support\Facades\Broadcast;
use Porto\Core\Providers\Abstracts\CoreBroadcastsProvider;

class BroadcastServiceProvider extends CoreBroadcastsProvider
{

    public function boot() {
        Broadcast::routes();

        require app_path('Ship/Broadcasts/Routes.php');
    }
}