# 异常格式化

## 定义
您可以使用`ExceptionFormatter`格式化任何ExceptionResponse。

本功能使用第三方扩展包`Heimdal`来实现，更多信息可以访问[Heimdal文档](https://github.com/esbenp/heimdal)。

默认情况下使用`ExceptionFormatters`来格式化输出异常


## 规则
* 所有的`ExceptionFormatter` 必须 继承`Porto\Core\Exceptions\Abstracts\CoreExceptionsFormatter`

## 目录结构
```text
- app
    - Ship
        - Exceptions
            - Formatters
                - HttpExceptionFormatter.php 
                - ...
```

## 代码示例
```php
<?php

use Illuminate\Http\JsonResponse;

class AuthorizationExceptionFormatter extends \Porto\Core\Exceptions\Abstracts\CoreExceptionsFormatter{
    CONST STATUS_CODE=403;
    
    public function responseData(Exception $exception,JsonResponse $response) : array{
        return [
            'code'=>$exception->getCode(),
            'message'=>$exception->getMessage(),
            'errors'=>'您无权访问此资源！',
            'status_code'=>self::STATUS_CODE
        ];
    }
    
    public function modifyResponse(Exception $exception,JsonResponse $response) : JsonResponse{
        if (count($headers = $exception->getHeaders())) {
            $response->headers->add($headers);
        }
        
        return $response;
    }   
    
    public function statusCode() : int{
         return self::STATUS_CODE;
    }
}
```
> `responseData()` 是格式化处理的函数
>
> `STATUS_CODE` 是设置给响应头的状态代码
>
> `modifyResponse()` 允许您在需要时更改response

## 注册格式化
新建一个异常格式化类后需要注册在`app/Ship/Configs/optimus.heimdal.php`文件中注册才能生效。
```php
<?php
[
    'formatters' =>[
        SymfonyException\HttpException::class => YourCustomExceptionFormatter::class,
    ]
];
```
> `formatter`配置的顺序很重要。