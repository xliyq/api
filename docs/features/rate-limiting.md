# 限速

限速功能默认使用Laravel的`throttle`中间件。所有的请求都会受到限制，以防止滥用和确保稳定性。

默认速率限制是` 1 分钟`，允许` 30 次`请求。如需更改请打开`app/Ship/Configs/porto.php`或者`.env`
```php
'throttle' => [
    'enabled' => env('API_RATE_LIMIT_ENABLED', true),
    'attempts' => env('API_RATE_LIMIT_ATTEMPTS', '30'),
    'expires' => env('API_RATE_LIMIT_EXPIRES', '1'),
]
```

```text
API_RATE_LIMIT_ENABLED=true
API_RATE_LIMIT_ATTEMPTS=30
API_RATE_LIMIT_EXPIRES=1
```

对于请求的限速信息可以检查响应头
```text
X-RateLimit-Limit →30
X-RateLimit-Remaining →29
```