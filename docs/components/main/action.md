# Action

## 规则
* 所有类 **必须** 继承`Porto\Core\Actions\CoreAction`

## 目录结构
```text
- app
    - Containers
        - {container-name}
            - Actions
                - CreateUserAction.php
```

## 代码示例
```php
<?php

class CreateUserAction extends \Porto\Core\Actions\CoreAction{
    
    public function run(\Porto\Core\Dto\DataDto $dto):User{
        $admin = Porto::call('User@CreateUserByCredentialsTask', [
                    $dto->email,
                    $dto->password,
                    $dto->name,
                ]);
        
        Porto::call('Authorization@AssignUserToRoleTask', [$admin, ['admin']]);
        return $admin;
    }
}
```
> 注意：劲量不要使用`string $email,string $password,string $name`进行数据传递，考虑使用[DTO](components/main/dto.md)。
>
> 在其他地方调用`Action` 请不要使用自动注入的形式。请使用`Porto::call()`来进行调用。