# 单一业务逻辑（Task） 

## 规则
* 所有类 **必须** 继承`Porto\Core\Tasks\CoreTask`

## 目录结构
```text
- app
    - Containers
        - {container-name}
            - Task
                - CreateUserByCredentialsTask.php
```

## 代码示例
```php
<?php

class CreateUserByCredentialsTask extends Porto\Core\Tasks\CoreTask
{
    private $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function run(
        string $phone,
        string $password,
        string $name,
        $avatar_url = null): User {
        try {
            return $this->repository->create([
                'password' => Hash::make($password),
                'phone'    => $phone,
                'name'     => $name,
//                'avatar_url' => $avatar_url
            ]);
        } catch (\Exception $exception) {
            throw (new CreateResourceFailedException())->debug($exception);
        }
    }
}

```