<?php


namespace App\Containers\Documentation\UI\CLI\Commands;


use Porto\Core\Commands\CoreCommands;
use Porto\Core\Support\Facades\Porto;

class GenerateApiDocsCommand extends CoreCommands
{
    protected $signature = 'api:docs';

    protected $description = '生成接口文档（使用apiDos）';


    public function handle() {
        Porto::call('Documentation@GenerateDocumentationAction', [$this]);
    }

}