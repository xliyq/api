# 迁移(Migrations)

## 原则
* `Migrations` 必须 在容器文件中创建。
* `Migrations`将在框架中自动加载。

## 规则
* 不需要发布文件到`database/migrations`，直接运行`artisan migrate`。

## 目录结构
```text
- app
    - Containers
        - User
            - Data
                - Migrations
                    - 2019_05_31_062744_create_user_tables.php
```

## 代码示例
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}

```