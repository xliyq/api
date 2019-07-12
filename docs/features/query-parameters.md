# 查询参数

## 排序
`?sortedBy=` 与 `orderBy` 2个参数通常一起使用，默认`orderBy`为`asc`(升序)，如果需要按照降序排列，需要添加`&sortedBy=desc`
示例1： id升序排列
```text
?orderBy=id&sortedBy=asc
```
示例2：创建时间倒序排列
```text
?orderBy=created_at&sortedBy=desc
```

> 由[prettus/l5-repository](https://packagist.org/packages/prettus/l5-repository)提供

## 搜索
`?search=`参数可以应用于任何 `GET` 方式的 HTTP 请求。

要使`search`有效，您需要将`FieldSearchable`添加到Model(模型)中
```php
<?php
class UserModel extends \Porto\Core\Models\CoreModel {
    
    protected $fieldSearchable=[
        'name',
        'email'
    ];
    
    //OR
    //protected $fieldSearchable=[
    //    'name'=>'like',
    //    'email'=>'=',
    //];
}
```
示例：
```text
?search=zhangsan
?search=name:zhang
?search=email:admin@admin.com
```

> search中的值需要进行`urlencode`处理
>
> 由[prettus/l5-repository](https://packagist.org/packages/prettus/l5-repository)提供

## ~~ 过滤 ~~
`?filter=`参数可以应用于任何 HTTP 请求。通过过滤`Response`中的数据来控制接口返回的大小。

示例：
```text
?filter=id;status
```

> 由[prettus/l5-repository](https://packagist.org/packages/prettus/l5-repository)提供

## 分页
`?page=`参数可以应用于任何列表的`GET`方式的 HTTP 请求，主要用于分页数据。

示例：
```text
?page=200
```


## 限量

`?limit=`参数可以用于定义每页返回的数据量。

示例：每页返回`20`条，访问第`2`页数据
```text
?limit=20&page=2
```

为了允许访问列表的所有数据（禁用分页），首先需要将`PAGINATION_SKIP`设置为`true`。然后通过`?limit=0`来获取所有数据。

## 关联(include)

返回对象的关联数据，为了能够正常工作，你需要在`Resource`中定义关系，具体如何定义请查看[Resource](../components/main/resource.md)。

可以通过添加`?include`参数来获取对象的关联数据，多个关联使用`,`分割。例如：
```text
?include=roles,permission
```

## 跳过缓存

要运行新查询并强制禁用该数据的换成，可以使用参数`?skipCache=true`。

> 注意：需要开启查询换成功能。请检查配置文件中`ELOQUENT_QUERY_CACHE`。
>
> 由[prettus/l5-repository](https://packagist.org/packages/prettus/l5-repository)提供