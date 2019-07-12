<?php


namespace App\Containers\Documentation\Actions;


use Porto\Core\Actions\CoreAction;

class GenerateDocumentationAction extends CoreAction
{

    function run($console): void {
        $this->call('Documentation@RenderTemplatesTask');

        $types = $this->call('Documentation@GetAllDocsTypesTask');

        $console->info("生成文档" . implode(' & ', $types) . "\n");

        $documentationUrls = array_map(function ($type) use ($console) {
            $path = $this->call('Documentation@GenerateAPIDocsTask', [$type, $console]);
            $this->call('Documentation@GenerateAPITask', [$type]);
            return $path;
        }, $types);

        $console->info('文档生成成功\n' . implode("\n", $documentationUrls));
    }
}