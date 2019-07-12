<?php


namespace App\Containers\Authentication\Tasks;


use Illuminate\Support\Facades\Config;
use Porto\Core\Tasks\CoreTask;

class MakeRefreshCookieTask extends CoreTask
{

    public function run($refreshToken) {
        $refreshCookie = cookie(
            'refreshToken',
            $refreshToken,
            Config::get('porto.api.refresh-expires-in'),
            null,
            null,
            false,
            true
        );
        return $refreshCookie;
    }
}