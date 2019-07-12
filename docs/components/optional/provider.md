# 服务提供者(Provider)

## 原则
*  容器中有2种类型的ServiceProvider: `MainServiceProvider`、其他ServiceProvider（`EventServiceProvider`、`BroadcastServiceProvider`
、`AuthServiceProvider`、`MiddlewareServiceProvider`、`RouteServiceProvider`）。
* 容器中不限制ServiceProvider的数量。
* 容器中只能有一个`MainServiceProvider`。
* MainServiceProvider 是所有ServiceProvider 注册的地方。
* 第三方扩展包的ServiceProvider 必须在MainServiceProvider中注册（Aliases也是）。
* 如果ServiceProvider 是通用的，或者多个容器使用，这可以在ShipServiceProvider中注册（Aliases也是）。

## 规则
* MainServiceProvider由ShipServiceProvider自动注册，**不需要** 在其他地方进行手动注册。
* 所有的MainServiceProvider **必须** 继承 `Porto\Core\Providers\Abstracts\CoreMainProvider`。
* 所有其他ServiceProvider（EventServiceProvider、BroadcastServiceProvider、AuthServiceProvider、MiddlewareServiceProvider
、RouteServiceProvider） **必须** 继承 `Porto\Core\Providers\Abstracts\*`。
* MainServiceProvider **必须** 在容器中命名为`MainServiceProvider`。
* 不应该在框架`config/app.php`中注册任何ServiceProvider，只有ShipServiceProvider在哪里注册。

> 由于框架的结构，Laravel5.5引入的自动发现功能会扰乱框架的加载方式。因此框架关闭了自动发现功能，所以所有的第三方ServiceProvider
> 都必须在容器中手动注册

## 目录结构
```text
- app 
    - Containers
        - User
            - Providers
                - MainServiceProvider.php
                - EventServiceProvider.php

```
> 在上面的结构中你只需要在`MainServiceProvider` 中注册`EventServiceProvider`。而`MainServiceProvider`将会被自动注册

## 代码示例
```php
<?php 
class MainServiceProvider extends \Porto\Core\Providers\Abstracts\CoreMainProvider{
    protected $serviceProviders=[];
    
    public $aliases=[];
    
    public function boot(){
      parent::boot(); 
    }
}
```
> 注意：在`MainServiceProvider` 中定义了`register()`或者`boot()`方法是，必须调用父类函数(`parent::register()` 或者 `parent::boot()`)

## 注册ServiceProvider

### 容器中的MainServiceProvider
不要在任何地方注册`MainServiceProvider`，它会被自动注册，并负责注册容器中其他的ServiceProvider。

### 容器中的其他ServiceProvider
必须在MainServiceProvider中注册，如下所示
```php
<?php 

class MainServiceProvider extends \Porto\Core\Providers\Abstracts\CoreMainProvider{
    protected $serviceProviders=[
        EventServiceProvider::class,
    ];
    public $aliases=[
        'hashId'=>Hashids::class
    ];
}
```
> aliases 也是如此。



