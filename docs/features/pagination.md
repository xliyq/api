# 分页

通过[l5-repository]来实现分页功能，只需要在任一`Repository`中使用`paginate`函数，就会应用分页功能。
示例：`$data = $demoRepository->paginate();`。

## 修改默认分页限制

打开`.env`文件，设置`PAGINATION_LIMIT_DEFAULT`值
```text
PAGINATION_LIMIT_DEFAULT = 10
```

## 通过查询参数更改每页数量

`?limit=`参数可以用于定义每页返回的数据量。

示例：每页返回`20`条，访问第`2`页数据
```text
?limit=20&page=2
```

## 跳过分页限制

为了允许访问列表的所有数据（禁用分页），首先需要将`PAGINATION_SKIP`设置为`true`。然后通过`?limit=0`来获取所有数据。