# 操作日志

操作日志是通过使用`active-log`第三方扩展包来实现的，更多信息请[查看文档](https://docs.spatie.be/laravel-activitylog/v3/introduction/)。

框架提供了 `Porto\Core\Traits\ActivityTrait` 用来实现操作日志的基本工作。

> 注意：`Porto\Core\Models\CoreModel`默认已经使用了`Porto\Core\Traits\ActivityTrait`

## 开启 / 关闭
1. 编辑`.env`文件中`ACTIVITY_LOGGER_ENABLED` 或者直接编辑`app/Ship/Config/activity-log.php`文件中的`enabled`
