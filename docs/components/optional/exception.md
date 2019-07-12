# 异常

## 定义
异常是处理错误的类，并帮助开发人员以更有效的方式调试代码。

## 原则
* 异常可以在应用程序的任何地方抛出（`throw`）。
* 容器特有的异常应该在容器内创建，通用的异常应该在`Ship`内创建

## 规则
* 所有的异常 **必须** 继承`Porto\Core\Exceptions\Abstracts\CoreException`
* 通用异常 **必须** 在`app\Ship\Exceptions\*`中创建
* 每个异常都必须有2个属性`$httpStatusCode`、`$message`。

> 当出现错误时，这`$httpStatusCode`、`$message`属性都将展示出来，可以在抛出异常时重写这2个属性。

## 目录结构
```text
- app
    - Containers
        - {container-name}
            - Exceptions
                - CreateFailedException.php
    - Ship
        - Exceptions
            - IncorrectIdException.php

```

## 代码示例
```php
<?php

class CreateFailedException extends \Porto\Core\Exceptions\Abstracts\CoreException{
    public $httpStatusCode=\Symfony\Component\HttpFoundation\Response::HTTP_CONFLICT;
    
    public $message='创建资源异常';
    
    public $code=10001;
    
}
```

### 异常的使用
```php
throw new CreateFailedException();

throw (new CreateFailedException())->debug($e);
``` 