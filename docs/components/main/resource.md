# Api资源(Resource)

## 规则
* 所有的接口响应 **必须** 通过Resource进行格式化。
* 所有类 **必须** 继承`Porto\Core\Resources\CoreResource`
* 每个`Resource`**必须** 在设置`$defaultFields`属性
   
## 目录结构
```text
- app
   - Containers
       - {container-name}
           - UI
               - API
                    - Resources
                        - UserResource.php
```

## 代码示例
```php
<?php 
class UserResource extends \Porto\Core\Resources\CoreResource{
    protected $defaultFields = ['id', 'phone', 'name', 'created_at'];
    
    protected $availableIncludes = [

    ];
    
    protected $defaultIncludes = [
        'roles'
    ];
    
    public function includeRoles() {
        return RoleResource::collection($this->roles);
    }
}
```
在控制器中的使用-单条数据
```php
return new UserResource($user);
```
在控制器中的使用-多条数据
```php
return UserResource::collect($users);
```

## 关联(include)
调用其他资源的关联可以通过如下2中方式实现：
1. 用户可以在响应中指定要返回的关系
    可以使用`?include=roles`，来指定要返回的数据关系，但是Resource要包含如下定义
```php
class UserResource extends \Porto\Core\Resources\CoreResource{
    protected $defaultFields = ['id', 'phone', 'name', 'created_at'];
    
    protected $availableIncludes = [
        'roles'
    ];
    
    protected $defaultIncludes = [
        
    ];
    
    public function includeRoles() {
        return RoleResource::collection($this->roles);
    }
}
```
2. 开发人员定义运行时要包含的关系
```php
class UserResource extends \Porto\Core\Resources\CoreResource{
    protected $defaultFields = ['id', 'phone', 'name', 'created_at'];
    
    protected $availableIncludes = [
        
    ];
    
    protected $defaultIncludes = [
        'roles'
    ];
    
    public function includeRoles() {
        return RoleResource::collection($this->roles);
    }
}
```