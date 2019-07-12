# ETag

## 中间件

提供了中间件(`Porto\Core\Middleware\ProcessETagHeadersMiddleware.php`)，实现了 HTTP协议缓存策略`ETAG`。用来减少客户端的带宽（特别是移动端）。

这个特性默认是关闭的。需要修改`app/Ship/Configs/porto.php`中的`use-etag`来开启。同时客户端访问也需要在请求头中发送`If-None-Match`才能使用该特性