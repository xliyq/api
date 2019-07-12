<?php


namespace App\Containers\Debugger\Tasks;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Porto\Core\Tasks\CoreTask;

class QueryDebuggerTask extends CoreTask
{
    public function run() {
        $debugEnabled = config('debugger.queries.debug');

        if ($debugEnabled) {
            $consoleOutputEnabled = config('debugger.queries.output.console');
            $logOutputEnabled = config('debugger.queries.output.log');

            DB::listen(function ($event) use ($consoleOutputEnabled, $logOutputEnabled) {
                $bindings = $event->bindings;

                foreach ($bindings as $key => $value) {
                    if ($value instanceof \DateTimeInterface) {
                        $bindings[$key] = $value->format(DB::getQueryGrammar()->getDateFormat());
                    } elseif (is_bool($value)) {
                        $bindings[$key] = (int)$value;
                    }
                }

                $fullQuery = vsprintf(str_replace(['%', '?'], ['%%', '%s'], $event->sql), $bindings);
                $result = "{$event->connectionName} ({$event->time} ms) :{$fullQuery}";
                if ($consoleOutputEnabled) {
                    dump($result);
                }
                if ($logOutputEnabled) {
                    Log::info($result);
                }

            });
        }

    }
}