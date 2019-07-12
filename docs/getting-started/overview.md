# 概述

## 基本流程
 收到HTTP请求后，会命中预定义的路由（每个路由都存在于相应的容器路由文件中）
 
 请求头的约定
 
 | header | value  | 什么时候需要 |
 | --- | --- | --- |
 | Accept       | application/json                  | 每个请求都需要 |
 | Content-Type | application/x-www-form-urlencoded | 发送数据的时候需要 |
 | Authorization| Bearer {Access-Token}             | 对需要用户身份的请求需要|
 | If-None-Match| xxxxxxxx                          | 用来做ETag缓存使用，当2次请求的etag相同时，返回HTTP 304|
 
 > 注意
 >
 > 通常在调用json Api时, 必须包含accept:application/json 的请求头信息，但是您可以通过在app/Ship/Configs/porto.php中设置
 > `force-accept-header=>false` 允许用户来跳过该设置，默认为`false`。
 
## `Route` 示例
```php
<?php
Route::get('hello','Controller@hello');
``` 
用户发起请求`[GET] http://xxx.com/v1/hello` 将调用定义的`Controller`中的`hello`方法

## `Controller` 示例
```php
<?php
class Controller extends \Porto\Core\Http\Controllers\ApiController {
    public function hello(HelloRequest $request){
        $message = Porto::call('Container-name@HelloAction');
        
        return $this->json([$message]);
    }
}
```
该示例中接收一个个HelloRequest类来自动检测用户是否有权限访问这个请求。只有当用户有权限访问时，才能成功进入函数体。

函数体中调用了一个`Action`(HelloAction)来执行业务逻辑

## `Action` 示例
```php
<?php
class HelloAction extends \Porto\Core\Actions\CoreAction{
    public function run(){
        return 'Hello World!';
    }
}
```
在`Action` 中可以执行任何操作，然后返回处理结果，返回类型可以是`object`、`string`、`void`...

当`Action` 完成工作后，`Controller`就可以构建`Response`了


## `Response` 示例
```json

```