# 约定

## RESTful API中HTTP方法用法

* `GET`(select)：从服务器中检索特定资源。
* `POST`(create)：在服务器上创建一个新资源。
* `PUT`(update)：更新服务器上的资源，提供整个资源。
* `PATCH`(update)：更新服务器上的资源，仅提供更改的属性。
* `DELETE`(delete)：从服务器中删除资源。


## 路由和操作的名称约定

* `GetAllResource`: 获取所有资源，可以应用`?search`查询参数来过滤数据。
* `FindResourceById`: 通过其唯一标识符搜索单个资源。
* `CreateResource`: 创建新资源。
* `UpdateResource`: 更新/编辑已有资源。
* `DeleteResource`: 删除资源。

## RESTful URL的一般准则和原则

* URL标识资源。
* 网址应包含名词，而不是动词。
* 使用复数名词只是为了一致性（没有单数名词）。
* 使用HTTP谓词（`GET`，`POST`，`PUT`，`DELETE`）对集合和元素进行操作。
* 您不应该比资源/标识符/资源更深入。
* 例如，将版本号放在URL的基础上`http://apiato.develop/v1/path/to/resource`。
* 如果输入数据更改了请求的逻辑，则应在URL中传递。如果没有可以进入标题“像Auth Token”。
* 不要使用查询参数来改变状态。
* 如果你能提供帮助，请不要使用混合案例路径; 小写是最好的。
* 不要在URI中使用特定于实现的扩展名（`.php`，`.py`，`.pl`等）
* 尽可能限制URI空间。并保持路径段短。
* 不要将元数据放在应该位于标题中的响应主体中

## 好的URL示例

## HTTP方法的一般原则

* 不要使用GET改变状态; 防止网页抓取机器人破坏您的数据。并尽可能使用GET。
* 除非您要更新整个资源，否则请勿使用PUT。除非你也可以在同一个URI上合法地进行GET。
* 不要使用POST来检索长期存在或可能合理缓存的信息。
* 不要执行PUT不是幂等的操作。
* 使用GET进行计算等操作,除非输入很大，在这种情况下使用POST。
* 如有疑问，请优先使用POST而不是PUT。
* 每当你必须做一些类似RPC的事情时，请使用POST。
* 将PUT用于较大或分层的资源类。
* 使用DELETE优先于POST以删除资源。