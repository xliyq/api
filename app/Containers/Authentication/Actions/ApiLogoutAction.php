<?php

namespace App\Containers\Authentication\Actions;

use Porto\Core\Dto\DataDto;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Lcobucci\JWT\Parser;
use Porto\Core\Actions\CoreAction;

class ApiLogoutAction extends CoreAction
{
    public function run(DataDto $data) {
        $id = App::make(Parser::class)->parse($data->bearerToken)->getHeader('jti');

        DB::table('oauth_access_tokens')->where('id', $id)->update(['revoked' => true]);
        return true;
    }
}
