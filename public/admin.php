<?php
// +----------------------------------------------------------------------
// | RXThink框架 [ RXThink ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;

// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';

// 支持事先使用静态方法设置Request对象和Config对象

// 检查是否安装
if (!is_file(__DIR__ . '/../install.lock')) {
    // 定义系统安装标记
    define('SYSTEM_INSTALL', true);

    // 执行应用并响应
    Container::get('app')->bind('install')->run()->send();
} else {
    // 执行应用并响应
    Container::get('app')->bind('admin')->run()->send();
}
