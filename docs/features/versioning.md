# API版本控制

Laravel 本身不支持API 的版本控制，框架中实现了一套简单的版本控制方案。

## 工作原理

### 创建

   按照如下命名格式创建一个新的路由文件，在文件名中指定版本号。`route.{version-number}.php`
   
   示例：
   * `route.v1.php`
   * `route.v2.php`
        
### 使用
    
   通过将路由文件中的版本号添加到URL，就可以访问到该版本的路由地址。
   
   示例：
   * /v1/xxx
   * /v2/xxx
   
## 开启 / 关闭 版本控制

1. 编辑`app/Ship/Confgis/porto.php`文件中的`enable_version_prefix=>true`。