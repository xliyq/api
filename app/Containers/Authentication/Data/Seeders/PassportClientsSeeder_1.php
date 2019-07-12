<?php


namespace App\Containers\User\Data\Seeders;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Porto\Core\Seeders\CoreSeeders;

class PassportClientsSeeder_1 extends CoreSeeders
{
    public function run() {
        $time = Carbon::now();
        $data = [
            'id'                     => 3,
            'name'                   => '',
            'secret'                 => 'w8icAchAZNLoporZgI8HyPg8NfA9aba1eiucLcSQ',
            'redirect'               => '',
            'personal_access_client' => 0,
            'password_client'        => 1,
            'revoked'                => 0,
            'created_at'             => $time,
            'updated_at'             => $time
        ];

        DB::table('oauth_clients')->insert($data);
    }
}