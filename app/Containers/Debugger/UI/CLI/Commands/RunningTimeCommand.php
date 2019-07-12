<?php


namespace App\Containers\Debugger\UI\CLI\Commands;


use Porto\Core\Commands\CoreCommands;
use DateTime;


class RunningTimeCommand extends CoreCommands
{

    protected $signature = 'debugger:running-time 
                                {--line= : 最大显示行数}
                                {--start= : 起始日期}
                                {--end= : 截止日期}
                                {--path= : 统计地址}
                                ';

    protected $description = '统计请求的运行时间';

    public $line;

    /**
     * @var DateTime
     */
    public $start;

    /**
     * @var DateTime
     */
    public $end;

    protected $logPath;

    public function __construct() {
        parent::__construct();

        $this->logPath = storage_path('logs/') . config('debugger.running_time.log_file');
        $this->logPath = dirname($this->logPath);
    }

    public function handle() {
        $start = microtime(true);
        $options = $this->options();

        $this->line = $options['line'] ?? 10;
        try {
            $this->start = isset($options['start']) ? (new DateTime($options['start'])) : (new DateTime())->modify('-6 days');
            $this->end = isset($options['end']) ? (new DateTime($options['end'])) : (new DateTime());
        } catch (\Exception $exception) {
            return;
        }

        if (isset($options['path'])) {
            // 指定地址
            $this->pathTime($options['path']);
        } else {
            $this->longestTime();
        }
        $this->info('耗时：' . round(microtime(true) - $start, 2) . ' s');
        $this->info('使用内存：' . round(memory_get_peak_usage(true) / 1024 / 1024, 2) . 'M');
    }

    /**
     * 统计字段地址的数据
     *
     * @param $pathUri
     */
    private function pathTime($pathUri) {
        $files = $this->getLogFiles();

        $times = $max = $min = 0;
        $storePath = array_pad([], $this->line, 0);

        $storedPath = collect();

        $count = 0;

        // 遍历文件
        foreach ($files as $logs) {
            !is_array($logs) && $logs = [$logs];
            //遍历文件内的日志
            foreach ($logs as $log) {
                if (strlen(trim($log)) === 0) {
                    continue;
                }
                // 解析日志
                $log = substr($log, strpos($log, '.INFO:') + strlen(".INFO:"));
                list($time, $path, $params) = explode('||', trim($log));

                // 过滤指定的pathUri
                if ($path === $pathUri) {
                    // 指定到数组最后一位
                    end($storePath);
                    $lastKey = key($storePath);
                    //比较数据和排序处理
                    if ($time > $storePath[$lastKey]) {
                        //相同参数的保留保留时间最长的
                        if (isset($storePath[$params]) && $time > $storePath[$params]) {
                            $storePath[$params] = $time;
                        } else if (!isset($storePath[$params])) {
                            unset($storePath[$lastKey]);
                            $storePath[$params] = $time;
                        }
                        // 按值排序
                        arsort($storePath);
                    }

                    $times += $time;

                    if ($time > $max || $max == 0) $max = $time;
                    if ($time < $min || $min == 0) $min = $time;
                    ++$count;
                }
            }
        }


        $storePath = array_filter($storePath);
        foreach ($storePath as $key => &$item) {
            $item = [$item, $key];
        }

        $average = round($times / $count, 2);
        $this->table(['path', 'average (s)', 'max (s)', 'min (s)', 'count'], [[$pathUri, $average, $max, $min, $count]]);

        $this->info("Top {$this->line} request reversed by time and uniqued by params with path $pathUri:");
        $this->table(['time (s)', 'params'], $storePath);
    }

    private function getLogFiles() {
        $files = [];
        $days = $this->end->diff($this->start)->format('%a');
        for ($n = 0; $n <= $days; $n++) {
            $files[] = $this->logPath . '/debugger-' . $this->start->format('Y-m-d') . '.log';
            $this->start->modify('+1 days');
        }

        foreach ($files as $file) {
            if (file_exists($file)) {
                yield file($file);
            }
        }

    }

    /**
     * 计算耗时最长的
     */
    private function longestTime() {
        $files = $this->getLogFiles();
        $pathTimes = $times = [];

        foreach ($files as $logs) {
            !is_array($logs) && $logs = [$logs];

            foreach ($logs as $log) {
                if (strlen(trim($log)) === 0) {
                    continue;
                }
                // 解析日志
                $log = substr($log, strpos($log, '.INFO:') + strlen(".INFO:"));

                list($time, $path) = explode('||', trim($log));

                if (!isset($pathTimes[$path])) {
                    $pathTimes[$path] = [
                        'path'  => $path,
                        'max'   => 0,
                        'min'   => PHP_INT_MAX,
                        'count' => 0,
                        'total' => 0,
                    ];
                }

                if ($time > $pathTimes[$path]['max']) $pathTimes[$path]['max'] = $time;
                if ($time < $pathTimes[$path]['min']) $pathTimes[$path]['min'] = $time;
                ++$pathTimes[$path]['count'];
                $pathTimes[$path]['total'] += $time;

            }
        }

        foreach ($pathTimes as $path => &$time) {
            $avg = round($time['total'] / $time['count'], 2);

            $time = [
                'path'  => $path,
                'avg'   => $avg,
                'max'   => $time['max'],
                'min'   => $time['min'],
                'count' => $time['count']
            ];
            $times[$path] = $avg;
        }

        arsort($times);
        $times = array_slice($times, 0, $this->line);
        foreach ($times as $k => &$time) {
            $time = $pathTimes[$k];
        }

        $this->table(['path', 'avg(s)', 'max(s)', 'min(s)', 'count'], $times);
        if (!empty($times)) {
            $this->info('查看单个请求的统计命令：php artisan debugger:running-time --path=' . current($times)['path']);
        }
    }
}