<?php


namespace App\Containers\Authentication\Tasks;


use Illuminate\Support\Facades\Auth;
use Porto\Core\Tasks\CoreTask;

class GetAuthenticatedUserTask extends CoreTask
{

    public function run() {
        return Auth::user();
    }
}