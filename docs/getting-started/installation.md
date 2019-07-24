
# 安装

### 服务器要求
* php >= 7.2
* phpunit >= 7.5
* php扩展
    * OpenSSL PHP扩展
    * PDO PHP扩展
    * Mbstring PHP扩展
    * Tokenizer PHP扩展
    * BCMath PHP扩展（启用哈希ID功能时需要）
    * Intl扩展（使用本地化容器时需要）

### 安装

1. 发布配置
```bash
    php artisan vendor:publish  --tag=porto-core-config
```

### 数据库设置
1. 迁移数据库
```bash
    php artisan migrate
```
2. 填充数据
```bash
    php artisan db:seed
```

> 默认会生成系统管理员
>
> 账号：admin@admin.com 
>
> 密码：123456

### OAuth 2.0 设置
1. 通过`laravel/passport` 扩展包生成访问令牌
```bash
    php artisan passport:install
```
2. 生成`oauth`秘钥文件
```bash
    php artisan passport:keys
```


### 文档生成

### 测试
1. 确保本地安装`phpunit`版本大于等于 7.5
2. 运行测试
```bash
    vendor/bin/phpunit
```