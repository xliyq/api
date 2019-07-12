## **使用概况**

下面是一些信息，可以帮助您了解RESTfulAPI的基本用法。
包括有关验证用户、发出请求、响应、潜在错误、速率限制、分页、查询参数等的信息。

### **Headers**

某些API调用要求您以特定格式发送数据，作为API调用的一部分。

默认情况下，所有API调用都希望输入为`json`格式，但是您需要通知服务器您正在发送一个json格式的有效负载。

要做到这一点，您必须在每次调用中包含`accept=>application/json`HTTP头。


| Header        | Value Sample                        | When to send it                                                              |
|---------------|-------------------------------------|------------------------------------------------------------------------------|
| Accept        | `application/json`                  | MUST be sent with every endpoint.                                            |
| Content-Type  | `application/x-www-form-urlencoded` | MUST be sent when passing Data.                                              |
| Authorization | `Bearer {Access-Token-Here}`        | MUST be sent whenever the endpoint requires (Authenticated User).            |

### **限速**
所有REST API请求都受到限制，以防止滥用并确保稳定性。您的应用程序每天可以进行的确切呼叫数量会根据您提出的请求类型而有所不同。

速率限制窗口是`{{rate-limit-expires}}`每个端点的分钟数，大多数单独的呼叫允许`{{rate-limit-attempts}}`每个窗口中的请求。

换句话说，允许每个用户每`{{rate-limit-expires}}` 分钟对每个接口进行`{{rate-limit-attempts}}`呼叫。（对于每个唯一的访问令牌）。

对于可以在端点上执行的命中数，您可以随时检查标题：

```
X-RateLimit-Limit → 30
X-RateLimit-Remaining → 29
```

### **令牌**

访问令牌适用于`{{access-token-expires-in}}`。（相当于`{{access-token-expires-in-minutes}}`分钟）。
而Refresh Token则适用于`{{refresh-token-expires-in}}`。（相当于{{refresh-token-expires-in-minutes}}分钟）。

*您需要在令牌过期时重新验证用户身份。*


### **分页**

默认情况下，所有提取请求都会返回`{{pagination-limit}}`列表中的第一个项目。检查查询参数以了解如何控制分页。

### **限制:** 

该`?limit=`参数可用于定义请求应返回多少条记录（另请参阅`Pagination`！）。

**用法:**

```
api.domain.dev/endpoint?limit=100
```

上面的示例返回100个资源。

该`limit`和`page`查询参数，以获得下一个100级的资源进行组合：

```
api.domain.dev/endpoint?limit=100&page=2
```

您可以跳过分页限制以获取所有数据，通过添加`?limit=0`，这仅在服务器上启用`skip pagination`时才有效。

### **响应**

除非另有说明，否则所有API端点都将以JSON数据格式返回您请求的信息。


#### 标准响应格式

```shell
{
  "data": {
    "object": "Role",
    "id": "owpmaymq",
    "name": "admin",
    "description": "Administrator",
    "display_name": null,
    "permissions": {
      "data": [
        {
          "object": "Permission",
          "id": "wkxmdazl",
          "name": "update-users",
          "description": "Update a User.",
          "display_name": null
        },
        {
          "object": "Permission",
          "id": "qrvzpjzb",
          "name": "delete-users",
          "description": "Delete a User.",
          "display_name": null
        }
      ]
    }
  }
}
```

#### Header

Header Response:

```
Content-Type → application/json
Date → Thu, 14 Feb 2014 22:33:55 GMT
ETag → "9c83bf4cf0d09c34782572727281b85879dd4ff6"
Server → nginx
Transfer-Encoding → chunked
X-Powered-By → PHP/7.0.9
X-RateLimit-Limit → 100
X-RateLimit-Remaining → 99
```

### **查询参数**

查询参数是可选的，您可以在需要时将它们应用于某些端点。

#### Ordering

`?orderBy=`参数可以应用于**`GET`** 负责按字段排序记录列表的任何HTTP请求。

**用法:**

```
api.domain.dev/endpoint?orderBy=created_at
```

#### Sorting

`?sortedBy=`参数通常与`orderBy`参数一起使用。

默认情况下`orderBy`，按**升序**对数据进行排序，如果希望数据按**降序**排序，则可以添加`&sortedBy=desc`。

**用法:**

```
api.domain.dev/endpoint?orderBy=name&sortedBy=desc
```

Order By Accepts:

- `asc` 升序.
- `desc` 用于降序.

#### Searching

 `?search=`参数可以应用于任何 **`GET`** HTTP请求。

**用法:**

##### 搜索任何字段:

```
api.domain.dev/endpoint?search=keyword here
```

> 空格应替换为`%20`（search = keyword％20here）。

##### 在任何字段中搜索多个关键字:

```
api.domain.dev/endpoint?search=first keyword;second keyword
```

##### 在特定领域搜索:
```
api.domain.dev/endpoint?search=field:keyword here
```

##### 在特定字段中搜索多个关键字: 
```
api.domain.dev/endpoint?search=field1:first field keyword;field2:second field keyword
```

##### 定义查询条件:

```
api.domain.dev/endpoint?search=field:keyword&searchFields=name:like
```

可用条件: 

- `like`: 字符串就像字段. (SQL查询 `%keyword%`).
- `=`: 字符串完全匹配.


##### 定义多个字段的查询条件:

```
api.domain.dev/endpoint?search=field1:first keyword;field2:second keyword&searchFields=field1:like;field2:=;
```

#### ~~ Filtering ~~

`?filter=` 参数可以应用于任何HTTP请求。并通过定义您想要在响应中返回的数据来控制响应大小。

**用法:**

仅返回该模型中的ID和名称（其他所有内容都将返回 `null`).

```
api.domain.dev/endpoint?filter=id;status
```

示例响应，仅包括id和status:

```json
{
  "data": [
    {
      "id": "0one37vjk49rp5ym",
      "status": "approved",
      "products": {
        "data": [
          {
            "id": "bmo7y84xpgeza06k",
            "status": "pending"
          },
          {
            "id": "o0wzxbg0q4k7jp9d",
            "status": "fulfilled"
          }
        ]
      },
      "recipients": {
        "data": [
          {
            "id": "r6lbekg8rv5ozyad"
          }
        ]
      },
      "store": {
        "data": {
          "id": "r6lbekg8rv5ozyad"
        }
      }
    }
    ]
}
```


#### Paginating

`?page=` 参数可以应用于任何**GET**负责列出记录的HTTP请求（主要用于分页数据）

**用法:**

```
api.domain.dev/endpoint?page=200
```

*当分页在端点上可用时，分页对象始终在 **meta**返回。*

```shell
  "data": [...],
  "meta": {
    "pagination": {
      "total": 2000,
      "count": 30,
      "per_page": 30,
      "current_page": 22,
      "total_pages": 1111,
      "links": {
        "previous": "http://api.domain.dev/endpoint?page=21"
      }
    }
  }
```

#### Relationships

`?include=` 参数可以与任何端点一起使用，只有它支持它。

如何使用它：假设有一个Driver对象和Car对象。还有一个`/cars`返回所有汽车对象的端点。包括允许汽车与他们的司机`/cars?include=drivers`。

但是，`/cars`要使此参数起作用，端点应明确定义它接受`driver`为关系（在**可用关系**部分中）。

**用法:**

```
api.domain.dev/endpoint?include=relationship
```

每个响应包含`include` 在它的 `meta`  如下:

```
   "meta":{
      "include":[
         "relationship-1",
         "relationship-2",
      ],
```


#### Caching

一些端点在第一次查询后将其响应数据存储在内存中（缓存），以加快响应时间。该`?skipCache=`参数可用于强制从服务器缓存中跳过加载响应数据，而是在请求时从数据库中获取新数据。

**用法:**

```
api.domain.dev/endpoint?skipCache=true
```


### **Errors** (Outdated)


一般错误:

| Error Code | Message                                                                               | Reason                                              |
|------------|---------------------------------------------------------------------------------------|-----------------------------------------------------|
| 401        | 细分数量错误.                                                                         | 错误的令牌。                                        |
| 401        | 细分数量错误.                                                                         | 缺少部分令牌。                                      |
| 401        | 无法解码令牌：令牌......是无效的JWS.                                                  | 缺少令牌                                            |
| 405        | 方法不允许.                                                                           | 错误的端点URL。                                     |
| 422        | 输入无效。.                                                                           | 验证错误。                                          |
| 500        | 内部服务器错误。                                                                      | {一旦得到它就报告此错误。}                          |
| 500        | 此操作未经授权。                                                                      | 使用错误的HTTP动词。或使用未经授权的令牌            |

未完待续...


### **Requests**

调用未受保护的请求示例：

```shell
curl -X POST -H "Accept: application/json" -H "Content-Type: application/x-www-form-urlencoded; -F "email=admin@admin.com" -F "password=admin" -F "=" "http://api.domain.dev/v2/register"
```

调用受保护的请求（通过Bearer Token）示例：

```shell
curl -X GET -H "Accept: application/json" -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..." -H "http://api.domain.dev/v1/users"
```

