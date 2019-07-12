<?php


namespace App\Containers\Documentation\UI\CLI\Commands;


use Illuminate\Support\Facades\Route;
use Porto\Core\Commands\CoreCommands;

class DocsCommand extends CoreCommands
{
    protected $signature = 'docs';

    protected $description = '文档';

    public function handle() {
        $routes = Route::getRoutes();
        dd($routes);
    }
}