<?php


namespace App\Containers\Documentation\Tasks;


use App\Containers\Documentation\Traits\DocsGeneratorTrait;
use Porto\Core\Tasks\CoreTask;
use Illuminate\Support\Facades\Config;

class RenderTemplatesTask extends CoreTask
{
    use DocsGeneratorTrait;

    protected $headerMarkdownContent;

    const TEMPLATE_PATH = 'Containers/Documentation/ApiDocJs/shared/';
    const OUTPUT_PATH = 'api-rendered-markdowns/';

    public function run() {
        $this->headerMarkdownContent = file_get_contents(app_path(self::TEMPLATE_PATH . 'header.template.md'));

        $this->replace('api.domain.dev}', Config::get('porto.api.url'));
        $this->replace('{{rate-limit-expires}}', Config::get('porto.api.throttle.expires'));
        $this->replace('{{rate-limit-attempts}}', Config::get('porto.api.throttle.attempts'));
        $this->replace('{{access-token-expires-in}}', $this->minutesToTimeDisplay(Config::get('porto.api.expires-in')));
        $this->replace('{{access-token-expires-in-minutes}}', Config::get('porto.api.expires-in'));
        $this->replace('{{refresh-token-expires-in}}', $this->minutesToTimeDisplay(Config::get('porto.api.refresh-expires-in')));
        $this->replace('{{refresh-token-expires-in-minutes}}', Config::get('porto.api.refresh-expires-in'));
        $this->replace('{{pagination-limit}}', Config::get('repository.pagination.limit'));

        $path = public_path(self::OUTPUT_PATH . 'header.md');

        file_put_contents($path, $this->headerMarkdownContent);

        return $path;
    }

}