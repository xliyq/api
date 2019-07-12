# 架构

## 介绍
在框架中2中常用的结构体系：
* Porto
    * `Route` 路由
    * `Request` 请求
    * `Controller` 控制器
    * `Action` 操作
    * `Task` 任务
    * `Model` 属性模型
    * `Resource` API资源
* MVC
    * `Model` 数据模型
    * `View` 视图
    * `Controller` 控制器
    
## Porto
 参考[文档](https://github.com/Mahmoudz/Porto)
 
## Containers

1. 删除 `Container`
    
    系统附带了一些默认的 `Container` 。所有的 `Container`都是可选的，其中一些 `Container`包含了必要的功能。
    如果不需要可以直接在 `Containers` 目录中删除相应的文件夹，然后运行 `composer update` 以删除其依赖。
    
2. 创建新 `Container`
    1. 命令行创建
    ```bash
    php artisan porto:container
    ```
    2. 手动创建
        * 在 `Containers` 目录中创建一个文件夹
        * 按照约定的目录结构创建目录及文件组件

## Ship 层 
    默认`Ship` 层提供了一些默认的功能，开发人员可以根据需要自行扩展
    
## 创建一个完整的`Container`流程
 我们以创建名称为`Application`的 Container 为例
1. 创建`Container`

2. 创建`Route`

    路由文件应存放在
    
    api : `app/Containers/Application/UI/API/Routes/`
    
3. 创建`Controller`

    控制器文件应存放在
    
    api: `app/Containers/Applicaiton/UI/API/Controllers`。 
    所有的 Controller 必须 `extends  \Porto\Core\Http\Controllers\ApiController` 
    
4. 创建`Model`

    模型类应该存在 `app/Containers/Application/Models`。 
    所有 Model 必须 `extend Porto\Core\Models\CoreModel`
5. 创建`Resource`

    资源类应该存在 `app/Containers/Application/UI/API/Resources`。
    所有的 Resource 必须 `extends \Porto\Core\Resources\CoreResource`
    
6. 创建`ServiceProvider`
    
    服务提供程序类位于`app/Containers/Application/Providers/`，但是也可以存在其他任何地方。
    
    但是如果希望自动加载服务提供程序（无需在`config/app.php`中注册），请将文件重命名为MainServiceProvider.php(完整路径：
    `app/Containers/Application/Providers/MainServiceProvider.php`)。
    否则需要手动注册。
    
7. 创建`Migration`
    
    迁移类位于`database/migrations/`或者`app/Containers/Applications/Data/Migrations/`，建议使用后者便于Container的管理。

8. 创建`Seeder`

    数据填充类位于`database/seeds/`或者`app/Containers/Applications/Data/Seeders/`，建议使用后者便于Container的管理。

## 使用特性

* 通过`Action`和`Task`来提供特性
    * 每个`Action`类都有单个函数`run`，只执行一个功能。
    * 每个`Task`类都用单个函数`run`，它只完成一个作业（业务逻辑的单一小部分）。
* `Action`和`Task`类使用方式
    * 使用Porto Facade 调用简单格式：`$data = Porto::call('Application@HelloAction',[$request])`
    * 使用Porto Facade 调用完整类名格式：`$data = Porto::call(HelloAction::class,[$request])`
    * 普通php调用方式：`$data =(new HelloAction::class)->run([$request])`
    * Laravel Ioc方式：`$data =\App::make(HelloAction::class)->run([$request])`