<?php


namespace App\Containers\Documentation\Tasks;


use Porto\Core\Tasks\CoreTask;
use Illuminate\Support\Facades\Config;

class GetAllDocsTypesTask extends CoreTask
{

    public function run() {
        if (!$configTypes = Config::get('document.types')) {
            return;
        }
        $types = [];

        foreach ($configTypes as $key => $value) {
            $types[] = $key;
        }
        return $types;
    }
}