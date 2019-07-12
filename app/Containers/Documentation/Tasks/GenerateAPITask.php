<?php


namespace App\Containers\Documentation\Tasks;


use App\Containers\Documentation\Traits\DocsGeneratorTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Porto\Core\Tasks\CoreTask;

class GenerateAPITask extends CoreTask
{
    use DocsGeneratorTrait;

    public function run($type) {
        // 读取api_data.json文件
        $documentationPath = base_path($this->getDocumentationPath($type));

        $content = file_get_contents($documentationPath . '/api_data.json');
        $api = json_decode($content, true);

        // 处理容器信息
        $api = collect($api)->map(function ($item) {
            $item['container'] = explode('/', $item['filename'])[2];
            return $item;
        });

        // 按照容器分组排序
        $apis = $api->sortBy('container')->groupBy('container');

//        Log::debug('api', $apis->toArray());
//        exit();


//        $apis = $api->groupBy('group');
        $paths = [];
        $baseUrl = config('porto.api.url');
        File::delete(File::glob($documentationPath . "/*.md"));
        foreach ($apis as $container => $item) {
            $item = $item->sortBy('group')->groupBy('group');
            $paths[$container] = [];
            foreach ($item as $name => $group) {
                $content = view('documentation::route')
                    ->with('name', $name)
                    ->with('group', $group)
                    ->with('baseUrl', $baseUrl)
                    ->render();
                $path = "$documentationPath/$name.md";
                file_put_contents($path, $content);
                $paths[$container][] = [
                    'name' => $name,
                    'path' => basename($path)
                ];
            }
        }

        $this->renderReadme($documentationPath);
        $this->renderSideBar($paths, $documentationPath);

    }


    private function renderReadme($path) {

        file_put_contents($path . "/README.md", " ");
    }

    private function renderSideBar(array $data, $path) {
        $content = view('documentation::sidebar')
            ->with('paths', $data)
            ->render();

        copy(public_path('api-rendered-markdowns/header.md'), $path . '/header.md');

        file_put_contents($path . "/_sidebar.md", $content);
    }

}