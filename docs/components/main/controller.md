# 控制器(Controller)

## 规则
* 所有的AP控制器 **必须** 继承`Porto\Core\Http\Controllers\ApiController`。
* 控制器 **应该** 使用`call`函数调用`Action`。(不要通过注入的形式来调用)。
* 控制器 **应该** 将`Request`对象传递给`Action`。

## 目录结构
```text
- app
    - Containers
        - {container-name}
            - UI
                - Controllers
                    - Controller.php
```

## 代码示例

 User API Controller
 ```php
<?php

class Controller extends \Porto\Core\Http\Controllers\ApiController{
    
    /**
     * 注册用户 
     * @param RegisterUserRequest $request
     * @return UserResource
     */
    public function registerUser(RegisterUserRequest $request){
        $user = Porto::call(RegisterUserAction::call,[$request]);
        
        return new UserResource($user);
    }
}
```

> 注意：使用`Porto::call`调用`Action` 时，会触发`Action`类中的`run`函数，并通知该`Action`是哪个`ui`调用的($this->getUI())。
> 用来区别不同类型的`UI`。
> 
> `call`函数的第二个参数是按照顺序排列`Action`类中的参数数组。当需要向`Action`传递数据时，建议使用`Request`对象。

## 助手函数

在`Porto\Core\Traits\ResponseTrait.php`中提供了很多函数，可以帮助您更快的构建`Response`。

* json: 将数组数据处理成json
* created
* accepted
* deleted
* noContent
