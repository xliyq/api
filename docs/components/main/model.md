# 模型(Model)

## 规则

* 所有类 **必须** 继承`Porto\Core\Models\CoreModel`
* **必须** 在对应的`Repository`类中设置`$container`属性
   
## 目录结构
```text
- app
   - Containers
       - {container-name}
           - Models
               - Demo.php
```

## 代码示例
```php
<?php

class Demo extends \Porto\Core\Models\CoreModel{
    protected $table = 'demos';
    
    protected $fillable = [];
    
    protected $hidden=[];
    
    protected $casts=[];
}

```