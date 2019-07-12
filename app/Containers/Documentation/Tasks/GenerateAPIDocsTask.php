<?php


namespace App\Containers\Documentation\Tasks;


use App\Containers\Documentation\Traits\DocsGeneratorTrait;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class GenerateAPIDocsTask
{

    use DocsGeneratorTrait;

    public function run($type, $console) {
        $path = $this->getDocumentationPath($type);


        $command = "apidoc -c {$this->getJsonFilePath($type)} {$this->getEndpointFiles($type)} -i app -o {$path}";

        $process = new Process($command);
        $process->run();
        $console->info($command);
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $console->info("[$type] . $command");
        $console->info("Result . {$process->getOutput()}");

        return $this->getFullApiUrl($type);

    }
}