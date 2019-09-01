<?php
// +----------------------------------------------------------------------
// | RXThinkCMF框架 [ RXThinkCMF ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink.cn@gmail.com>
// +----------------------------------------------------------------------

// 定义根域名
defined('URL_DOMAIN') or define('URL_DOMAIN', '.rxthink.com');
// 定义网站域名
defined('SITE_URL') or define('SITE_URL', 'http://www.rxthink.com');
// 定义后台域名
defined('MAIN_URL') or define('MAIN_URL', 'http://admin.rxthink.com');
// 定义WAP站域名
defined('WAP_URL') or define('WAP_URL', 'http://m.rxthink.com');
// 定义接口域名
defined('API_URL') or define('API_URL', 'http://api.rxthink.com');
// 定义脚本域名
defined('SCRIPT_URL') or define('SCRIPT_URL', 'http://script.rxthink.com');
// 定义静态域名
defined('STATIC_URL') or define('STATIC_URL', 'http://static.rxthink.com');
// 定义上传域名
defined('UPLOAD_URL') or define('UPLOAD_URL', 'http://upload.rxthink.com');
// 定义临时上传域名
defined('UPLOAD_TEMP_URL') or define('UPLOAD_TEMP_URL', 'http://upload.rxthink.com/temp');
// 定义普通图片域名
defined('IMG_URL') or define('IMG_URL', 'http://img.rxthink.com');
// 定义文章图片域名
defined('IMAGE_URL') or define('IMAGE_URL', 'http://images.rxthink.com');
// 定义文件上传目录
defined('ATTACHMENT_PATH') or define('ATTACHMENT_PATH', 'D:\sites\RXThinkCMF\RXThinkCMF_TP5.1_DEV\public\uploads');
// 定义图片上传目录
defined('IMG_PATH') or define('IMG_PATH', ATTACHMENT_PATH . "/img");
// 定义临时文件目录
defined('UPLOAD_TEMP_PATH') or define('UPLOAD_TEMP_PATH', IMG_PATH . '/temp');

//RabbitMQ配置
defined('MQ_IP') or define('MQ_IP', '127.0.0.1');
defined('MQ_PORT') or define('MQ_PORT', '5672');
defined('MQ_USER') or define('MQ_USER', 'guest');
defined('MQ_PWD') or define('MQ_PWD', 'guest');
defined('MQ_HOST') or define('MQ_HOST', '/');

//配置文件
return [
    // 企业全称
    'site_name' => 'RXThinkCMF_TP5.1专业版',
    // 企业简称
    'nick_name' => 'RXThinkCMF',
    // 数据库链接
    'db_config' => 'mysql://root:111111@127.0.0.1:3306/rxthink.v5.1',
    // 数据表前缀
    'db_prefix' => 'think_',
    // 数据库编码
    'db_charset' => 'utf8mb4',
    // 缓存驱动类型及链接(redis)
    'cache_config' => 'redis://:@127.0.0.1:6379/1',
//    // 缓存驱动类型及链接(memcache)
//    'cache_config' => 'memcache://:@127.0.0.1:11211',
//    // 缓存驱动(文件类型)
//    'cache_config' => 'file',
    // 缓存前缀
    'cache_key' => 'RX51',
    // 上传参数配置
    'upload' => [
        //上传图片参数配置
        'image_config' => [
            // 图片后缀限制
            'upload_image_ext' => 'jpg|png|gif|bmp|jpeg',
            // 最大上传文件大小(默认：10MB)
            'upload_image_size' => 1024 * 10,
            // 最大上传数量限制(默认：9张)
            'upload_image_max' => 9,
        ],
        //上传视频参数配置
        'video_config' => [
            // 视频后缀限制
            'upload_video_ext' => 'mp4|avi|mov|rmvb|flv',
            // 最大上传文件大小(默认：10MB)
            'upload_video_size' => 1024 * 10,
            // 最大上传数量限制(默认：3个)
            'upload_video_max' => 3,
        ],
    ],
];
