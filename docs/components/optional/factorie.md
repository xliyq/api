# 模型工厂(factory)

## 规则
* `Factories` 必须 在容器中创建。
* `Factories` 只是 一个普通的php脚本（不需要类或命名空间）

## 目录结构
```text
- app 
    - Containers
        - {container-name}
            - Data
                - Factories
                    - UserFactory.php
```

## 代码示例
```php
<?php
$factory->define(\App\Containers\User\Models\User::class, function (\Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = \Illuminate\Support\Facades\Hash::make('testing-password'),
        'remember_token' => str_random(10),
    ];
});
```

### 在任意地方使用
```php
<?php
factory(User::class,2)->create();
```

### 关联使用
```php
<?php 
$countries = Country::all();

$users = factory(User::class,2)->make()->each(function($user)use($countries){
   $user->save();
   $user->counties()->attach([$countries->random(1)->id]);
   $user->save();
});
```