# 请求(Request)

## 规则
* 所有的`Request` **必须** 继承`Porto\Core\Requests\Request`。
* `Request`中 **必须** 有`rules()`函数。
* `Request`中 **必须** 有`authorize()` 函数，用来检查访问权限。

> `authorize()`函数默认函数体为`$this->check(['hasAccess'])`。

## 目录结构
```text
- app
    - Containers
        - {container-name}
            - UI
                - API
                    - Requests
                        - UpdateUserRequest.php
                        - DeleteUserRequest.php
```

## 代码示例
```php
<?php

class UpdateUserRequest extends \Porto\Core\Requests\Request{
    protected $access=[];
    
    protected $decode=[];
    
    protected $urlParameters=[];
    
    public function rules(){
        return [
            'email'=>'email|unique:users,email',
            'password'=>'min:6',
        ];
    }
    
    public function authorize(){
     return parent::authorize();
    }
}
```

## 属性

### decode
`$decode` 属性是用于动态解码任何请求中的哈希ID。

如果启用了HashId特性。系统将接受和传递哈希ID,因此这些ID需要在某些地方进行解码。
在`Request`组件上可以通过该属性来指定那些哈希ID信息，以便于在验证规则之前对其进行解码。

示例：
```php
<?php

class DeleteUserRequest extends \Porto\Core\Requests\Request{
    protected $decode=[
        'user_id',
    ];
}
```

### urlParameters
`$urlParameters` 属性用于对URL参数应用验证规则。默认情况下，Laravel不允许验证URL参数。为了能够对URL
参数应用验证规则，只需要在`$urlParameters`属性中定义URL参数。

示例：
```php
<?php
class DemoRequest extends \Porto\Core\Requests\Request{
    /**
     *  /demo/123/items
     * @var array 
     */
    protected $urlParameters=[
        'id'    
    ];
    
    public function rules(){
        return [
            'id'=>'required|integer'    
        ];
    }
}
```

### access

`$access`属性允许用户定义一组可以访问此请求的角色和权限。

`$access`属性由`authorize()`函数中的`hasAccess`函数使用，用于检测用户是否具有调用此请求所需要的权限和角色。

示例：
```php
<?php
class DemoRequest extends \Porto\Core\Requests\Request{
    protected $access = [
        'permissions'=>'delete-xxx|delete-xxxxx',
        'roles'=>'admin'
    ];
    
    public function authorize(){
        return $this->check([
            'hasAccess|isOwner',
            'isAdmin'
        ]);
    }
}
```

 如果不喜欢用`|`分割不同的权限或角色，也可以使用数组来表示
```php
    protected $access = [
        'permissions'=>['delete-xxx','delete-xxxxx'],
        'roles'=>['admin']
    ];
```

*** 

## `authorize`运行流程
`authorize` 方法接受方法名数组参数，每个方法都返回一个布尔值。如在上面的示例中接受了3个方法`hasAccess`、`isOwner`、`isAdmin`。

方法之间的分隔符`|`表示“或”操作，因此方法`hasAccess`和`isOwner`只要有一个返回为`true`,则用户将获得访问权限。

另一个方法`isAdmin`如果返回`false`，无论其他函数返回什么，都将阻止用户访问请求，因为数组中所有的函数之间的默认操作是“与”

### 添加自定义授权方法

添加自定义授权方法的最佳方式是通过Trait。例如
```php
<?php 
trait IsAuthorPermissionTrait{
    public function isAuthor(){
        return Porto::call('User@CheckIfUserHasProperRoleTask',[$this->user(),['author']]);
    }
}

class FindUserByIdRequest extends \Porto\Core\Requests\Request{
    use IsAuthorPermissionTrait;
    
    public function authorize(){
        return $this->check(['isAuthor']);
    }
}
```

### 允许角色访问任何请求
可以允许一些角色访问系统中的每一个请求，而不必在每个请求对象中定义该角色。

`app/Ship/Configs/porto.php`
```php
'request'=>[
    'allow-roles-to-access-all-routes'=>['admin']
];
```
> 将`admin`角色附加到每个请求中，使`admin`角色有所有请求的访问权限。如果将`admin`改为`admin|manager`则表示
用户只要有`admin`、`manager`的任一角色都可以访问所有请求。


## 助手方法
### hasAccess
根据`$access`属性决定用户是否有访问权限。
* 如果用户机器任何权限或角色，将拥有访权限
* 如果需要更多（更少）的权限/角色时，只需要在`$access`属性上添加（减少）相应的权限/角色。
* 如果不需要设置权限时，只需要设置`permissions=>''`或者`permissions=>null`

### isOwner
检测URL传递的ID是否与请求的用户ID相同。

### getInputByKey
从`request`中获取解码后的数据

### sanitizeData
对于`PATCH`请求方式，如果想在API中只提交变更的数据以便于：
* 最小化流量
* 更新部分数据

需要检测请求中特定的`field`是否存在，会有大量的`if`语句块,如：
```php
if($request->has('name'){
    $data['name']=$request->input('name');
}
if($request->has('description')){
    $data['description']=$request->input('description');
}
```
为了避免这样的IF语句块，会使用`array_filter($data)`从请求中删除空字段。但是在php中`false`和""空字符串也会被认为是null,也会被删除掉。
这样显然无法满足要求。

为了解决这个问题，提供了一种方便的`sanitizeInput($fields)`方法。

数据样例：
```json
{
	"data" : {
		"is_private" : false,
		"description" : "this is a rather long description text",
		"a" : null,
		"b" : 3453,
		"foo" : {
			"a" : "a",
			"b" : "b",
			"c" : 1234
		},
		"bar" : [
		    "a", "b", "c"
		]
	}
}
```
```php
$fields = ['data.name','data.description','data.is_private','data.foo.c'];
$data = $request->sanitizeInput($fields);
```
> 注：可以同`$model->getFillable()`获取模型的可填充字段集合

数据结果：
```php
[
    "data"=>[
        "is_private"=>false,
        "description"=>"this is a rather long description text",
        "foo"=>[
            "c"=>1234
        ]
    ]
]
```

如果你希望将request中的输入映射到其他字段，以便于传递给`Action`或者`Task`。可以通过手动映射，也可以使用`mapInput(array $fields)`助手函数。
反过来，则是重定义key。

数据样例：
```json
{
"data": {
    "name": "name",
    "description": "description"
}
}
```

```php
$request->mapInput(['data.name'=>'data.description']);
//{"data":{"description":"name"}}
//

$request->mapInput(['data.description'=>'data.name']);
//{"data":{"name":"description"}}
//

```

## 对`Action`做单元测试（Request）
在针对`Action`做单元测试时，我们需要创建一个模拟请求，并将请求对象传递给`Action`。
示例：
```php
$data = [
    "email"=>"test@test.com",
    "name"=>"test",
    "password"=>"testtest"
];
$request = RegisterUserRequest::injectData($data);

$action = App::make(RegisterUserAction::class)->run($request);

 // ...

```
