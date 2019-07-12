# 认证

我们通过`中间件`在应用程序中做身份验证。

在项目中你可以使用以下2个身份验证中间件来保护您的路由：
* API : `auth:api`
* Web : `auth:web`

## API 身份验证（OAuth 2.0）

为了防止未经身份验证的用户访问API,可以使用`auth:api`中间件来进行保护
```php
<?php
Route::get('info','Controller@getInfo')->middleware(['auth:api']);

```

只有在向所有受`auth:api`保护的请求发送有效的访问令牌他们才可以被访问。

这个访问令牌的中间件有[`laravel/passport`](https://github.com/laravel/passport)提供。具体请阅读其文档了解更多信息。