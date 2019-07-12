# 配置

## 定义
配置是容器配置的文件。有关它们的详细信息查看该[文档](https://laravel.com/docs/5.8/configuration)。

在每个容器中，有2中类型的配置文件：
* 容器特定的配置文件（包含容器特定配置的配置文件）
* 容器第三方包配置文件（属于第三方包的配置文件）

## 规则
* 您的自定义配置文件和第三方软件包配置文件 **必须** 在容器中，除非它非常通用，可以放在`Ship`中。
* 容器可以拥有无限数量的配置文件。
* 发布第三方程序包配置文件时，将其手动移动到其容器或Ship 。
* 框架配置文件（由`laravel`提供）位于项目根目录的默认配置目录中。
* 您不应该将任何配置文件添加到config目录中。

## 目录结构
```text
- app
    - Containers
        - {container-name}
            - Configs
                - {container-name}.php
                - package-config.php
                - ...
        - Ship
            - Configs
                - porto.php
                - ...
- config
    - app.php
```