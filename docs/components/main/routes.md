# 路由

## 规则
* API路由文件必须依据其版本来命名。例如：`route.v1.php`、`route.v2.php`

## 目录结构
```text
- app
    - Containers
        - {container-name}
            - UI
                - API
                    - Routes
                        - route.v1.php
                        - route.v2.php

```

## 定义

具体定义请参考Laravel文档

## 保护路由

请查阅[特性 - 授权](/features/authorization.md)页面。