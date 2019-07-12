# 验证

使用Laravel 原始的[验证系统](https://laravel.com/docs/validation)。

在框架中，验证必须在`Request`组件中定义，且为每一个请求单独定义，因为每个请求可能有不能同的规则。一旦`Request`注入到控制器，验证规则就会自动应用。

`Request`可以帮助您验证用户数据、可访问性、资源所有权等等。

示例：
```php
<?php

class RegisterUserRequest extends \Porto\Core\Requests\Request{
    
    public function rules(){
        return [
            'email'=>'required|email|max:200|unique:users,email',
            'password'=>'require',
            'name'=>'require'
        ];
    }
}

```