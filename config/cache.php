<?php
use think\facade\Config;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 缓存设置
// +----------------------------------------------------------------------

// 获取自定义配置文件
$config = Config::get('app.config');

// 获取缓存配置
$cacheConfig = $config['cache_config'];
$cacheArr = explode('://:@', $cacheConfig);
$cache_type = strtolower($cacheArr[0]);
list($cache_host, $cache_port, $cache_db) = preg_split("/[:\/]/",$cacheArr[1]);

if($cache_type==='redis')
{
    $cache = [
        // 驱动方式
        'type'   => 'redis',
        // 服务器地址
        'host'   => $cache_host,
        // 服务器端口号
        'port'   => $cache_port,
        // 密码
        'password' => '',
        // 超时时间（单位：毫秒）
        'timeout'=> 3600,
        // 缓存数据库库号
        'select'     => 1,
        // 缓存前缀
        'prefix' => $config['cache_key'] . "_",
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ];
}else if($cache_type==='memcache')
{
    $cache = [
        // 驱动方式
        'type'   => 'Memcache',
        // 服务器地址
        'host'   => $cache_host,
        // 服务器端口号
        'port'   => $cache_port,
        // 超时时间（单位：毫秒）
        'timeout'=> 3600,
        // 缓存前缀
        'prefix' => $config['cache_key'] . "_",
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ];
}else {
    $cache = [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => '',
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ];
}

return $cache;
