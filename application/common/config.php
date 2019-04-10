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

/**
 * 全局配置
 * 
 * @author 牧羊人
 * @date 2019-02-25
 */

// 定义跟域名
define('URL_DOMAIN', '.rxthink.com');
// 定义网站域名
define('SITE_URL', 'http://www.rxthink.com');
// 定义后台域名
define('MAIN_URL', 'http://admin.rxthink.com');
// 定义WAP站域名
define('WAP_URL', 'http://m.rxthink.com');
// 定义接口域名
define('API_URL', 'http://api.rxthink.com');
// 定义脚本域名
define('SCRIPT_URL', 'http://script.rxthink.com');
// 定义静态域名
define('STATIC_URL', 'http://static.rxthink.com');
// 定义上传域名
define('UPLOAD_URL', 'http://upload.rxthink.com');
// 定义临时上传域名
define('UPLOAD_TEMP_URL', 'http://upload.rxthink.com/temp');
// 定义普通图片域名
define('IMAGE_URL', 'http://images.rxthink.com');
// 定义文章图片域名
define('IMG_URL', 'http://img.rxthink.com');
// 定义文件上传目录
define('ATTACHMENT_PATH', 'E:\xampp\htdocs\RXThink\RXThink5.1_V2.0_DEV\public\uploads');
// 定义图片上传目录
define('IMG_PATH', ATTACHMENT_PATH."/img");
// 定义临时文件目录
define('UPLOAD_TEMP_PATH', IMG_PATH . '/temp');

//配置文件
return [
    // 企业全称
    'site_name'     => 'RXThink_TP5.1版V2.0',
    // 企业简称
    'nick_name'     => 'RXThink框架',
    // 数据库链接
    'db_config'     => 'mysql://root:@127.0.0.1:3306/rxthink',
    // 数据表前缀
    'db_prefix'     => 'yk_',
    // 数据库编码
    'db_charset'    => 'utf8mb4',
    // 缓存驱动类型及链接
    'cache_config'  =>'redis://:@127.0.0.1:6379/1',
    // 缓存前缀
    'cache_key'     => 'RX51',
    // 上传参数配置
    'upload'        => [
        //上传图片参数配置
        'image_config'  => [
            // 图片后缀限制
            'upload_image_ext'  => 'jpg|png|gif|bmp|jpeg',
            // 最大上传文件大小(默认：10MB)
            'upload_image_size' => 1024*10,
            // 最大上传数量限制(默认：9张)
            'upload_image_max'  => 9,
        ],
        //上传视频参数配置
        'video_config'  => [
            // 视频后缀限制
            'upload_video_ext'  => 'mp4|avi|mov|rmvb|flv',
            // 最大上传文件大小(默认：10MB)
            'upload_video_size' => 1024*10,
            // 最大上传数量限制(默认：3个)
            'upload_video_max'  => 3,
        ],
    ],
];
