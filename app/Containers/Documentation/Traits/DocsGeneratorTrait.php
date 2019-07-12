<?php


namespace App\Containers\Documentation\Traits;


use Illuminate\Support\Facades\Config;

trait DocsGeneratorTrait
{

    private function getFullApiUrl($type) {
        return '>' . $this->getAppUrl() . '/' . $this->getUrl($type);
    }

    private function getAppUrl() {
        return Config::get('porto.api.url');
    }

    private function getHtmlPath() {
        return Config::get("{$this->getConfigFile()}.html_files");
    }

    private function getDocumentationPath($type) {
        return $this->getHtmlPath() . $this->getUrl($type);
    }

    private function getJsonFilePath($type) {
        return "app/Containers/Documentation/ApiDocJs/{$type}/";
    }

    private function getConfigFile() {
        return 'document';
    }

    private function getTypeConfig() {
        return Config::get($this->getConfigFile() . '.types');
    }

    private function getUrl($type) {
        $configs = $this->getTypeConfig();
        return $configs[$type]['url'];
    }

    private function getEndpointFiles($type) {
        $configs = $this->getTypeConfig();

        $routeFilesCommand = '';
        $routes = $configs[$type]['routes'];
        if (in_array('private', $routes)) {
            $routeFilesCommand .= ' -f  .php  -t ' . $this->getTemplatePath() . ' ';
        } else {
            $routeFilesCommand .= ' -f  .php  -t ' . $this->getTemplatePath() . ' ';
        }

        return $routeFilesCommand;
    }

    private function replace($templateKey, $value) {
        $this->headerMarkdownContent = str_replace($templateKey, $value, $this->headerMarkdownContent);
    }

    private function minutesToTimeDisplay($minutes) {
        $seconds = $minutes * 60;
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a day, %h hours, %i minutes and %s seconds');
    }

    private function getTemplatePath() {
        $template = Config::get($this->getConfigFile() . '.template');
        if ($template == 'docsify') {
            $templatePath = "app/Containers/Documentation/ApiDocJs/template/{$template}/";
        } else {
            $templatePath = './';
        }
        return $templatePath;
    }
}