<?php


namespace App\Containers\Debugger;


use Illuminate\Support\Facades\App;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger as MonologLogger;

class Logger
{

    CONST TESTING_ENV = 'testing';
    CONST REQUEST = 'requests';
    CONST RUNNING = 'running-time';

    protected $debuggingEnabled;

    protected $environment;

    protected $logger;

    protected $logFile;

    private $days;

    public function __construct(string $key = self::REQUEST) {
        $this->prepareConfigs($key);
        $this->prepareLogger($key);
    }

    public function releaseOutput(Output $output) {
        if ($this->environment != self::TESTING_ENV && $this->debuggingEnabled === true) {
            $this->logger->info($output->get());
        }
    }

    public function releaseRunningTime(array $running) {
        if ($this->environment != self::TESTING_ENV && $this->debuggingEnabled === true) {
            $logText = implode('||', $running);
            $this->logger->info($logText);
        }
    }

    private function prepareConfigs($key) {
        $this->environment = App::environment();
        if ($key === self::REQUEST) {
            $this->debuggingEnabled = config('debugger.requests.debug');
            $this->logFile = config('debugger.requests.log_file');
            $this->days = config('debugger.requests.days');
        } else {
            $this->debuggingEnabled = config('debugger.running_time.debug');
            $this->logFile = config('debugger.running_time.log_file');
            $this->days = config('debugger.running_time.days');
        }
    }

    /**
     * @param string $name
     */
    private function prepareLogger(string $name) {
        $handler = new RotatingFileHandler(storage_path('logs/' . $this->logFile), $this->days ?? 14);
        $handler->setFormatter(new LineFormatter(null, null, true, true));

        $this->logger = new MonologLogger(strtoupper($name) . ' DEBUGGER');
        $this->logger->pushHandler($handler);
    }
}