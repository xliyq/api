# 数据缓存

## 开启 / 关闭 ORM 查询缓存

默认情况下禁用缓存。如需开启，可以在`app/Ship/Configs/repository.php`文件中修改`cache` > `enable=>true`。
更多信息请查看[l5-repository](https://github.com/andersao/l5-repository#cache-config)。

## 不同缓存设置

您可以为每个`Repository`使用不同的缓存设置。要在每个`Repository`上设置缓存设置，首先必须启用缓存，然后需要在`Repository`类上设置一些属性以覆盖默认值。
```php
<?php

class DemoRepository extends \Porto\Core\Abstracts\Repositories\CoreRepository{
    
    // 缓存时间
    protected $cacheMinutes=90;
    
    //允许缓存的方法
    protected $cacheOnly=['all'];
    // 或者 排除缓存的方法设置
    protected $cacheExcept=[];
}

```

> 注意：不要使用`CacheableRepository` trait 或者实现 `CacheableInteface`，他们都已经存在于`Porto\Core\Abstracts\Repositories\CoreRepository`