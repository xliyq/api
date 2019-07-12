# 命令行

## 规则
* 容器可能有也可能没有一个或多个`Command`。
* 每个`Command`都 **应该**  调用一个`Action`来执行它的逻辑。并且 **不应该** 容纳任何业务逻辑。
* 所有`Command` **必须** 继承`\Porto\Core\Commands\CoreCommands`。

## 文件夹结构
```text
- app
    - Containers
        - {container-name}
            - UI
                - CLI
                    - Commands
                        - SayHelloCommand.php
                        - ...
    - Ship
        - Commands
            - GeneralCommand.php
            - ...
```

## 代码示例
```php
<?php


class SayWelcomeCommand extends \Porto\Core\Commands\CoreCommands
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'porto:welcome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Just saying Welcome.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Welcome to porto :)'); // green color
    }
}
```

### CLI用法
`php artisan porto:welcome`