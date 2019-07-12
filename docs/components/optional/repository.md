# 存储库(Repository)

## 定义
存储库类是存储库设计模式的实现。

它们的主要角色是将业务逻辑与数据（或数据访问任务）分开。

存储库将模型保存到底层存储机制，并从中检索模型。

存储库用于将检索数据并将其映射到模型的逻辑与作用于模型的业务逻辑分开。

## 原则
* 每一个`Model` **必须** 有一个`Repository`
* `Model`  **必须** 通过存储库来进行访问。**不应该** 直接访问`Model`

## 规则
* 所有的`Repository` 必须 继承 `Porto\Core\Abstracts\Repositories\CoreRepository`
* `Repository`名称 应该 与`Model`的名称相同(model:`User` -> repository:`UserRepository`)
* `Repository`类中 应该 设置`$container`属性

## 目录结构
```text
- app
    - Containers
        - {containers-name}
            - Data
                - Repositories
                    - UserRepository.php
```

## 代码示例
```php
<?php

class UserRepository extends \Porto\Core\Abstracts\Repositories\CoreRepository{
   
    protected $container='User';
    
    protected $fieldSearchable=[
        'name'=>'like',
        'email'=>'=',
    ];
}
```

## 其他属性

### API 查询参数属性
如果启用查询参数(`?search=key`)，需要在`Repository`中设置属性`$fieldSearchable`来指定模型的查询支持。
```php
    protected $fieldSearchable=[
        'name'=>'like',
        'email'=>'=',
    ];
```

### 其他属性
```php
protected $cacheMinutes=1440;// 1天

protected $cacheOnly=['all'];
```
> 框架中`Repository`的实现使用的是`l5-repository`扩展包，更多信息请[查看文档](https://packagist.org/packages/prettus/l5-repository)