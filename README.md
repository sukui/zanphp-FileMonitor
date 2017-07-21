# zanphp-FileMonitor
zanphp的开发环境文件修改自动重启代码,原理是通过定时器循环监控和对比目录下PHP文件的最后修改时间,从而判断文件是否更新，是否进行服务重启.

## 安装
1. 修改FileMonitor.php文件命名空间, 
```php
<?php
namespace Com\Youzan\ZanHttpDemo\Init\WorkerStart;

```
2. 配置项目init

修改项目init/WorkerStart/.config.php (如果没有就新建一个),加入文件监控代码

```php
<?php
/**
 * Created by PhpStorm.
 * User: laogui
 * Date: 2017/7/20
 * Time: PM2:17
 */

return [
    \Com\Youzan\ZanHttpDemo\Init\WorkerStart\FileMonitor::class
];

```

## 使用
安装正常项目启动即可


# 注意事项
本重启机制只适用开发环境方便调试。

尽管代码中判断运行环境。
但是，严禁在线上生产环境使用.
严禁在线上生产环境使用.

# 严禁在线上生产环境使用.