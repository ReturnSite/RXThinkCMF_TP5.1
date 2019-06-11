<?php

/**
 * 后台全局配置文件
 * @author 牧羊人
 * @date 2019/4/28
 */
return [

    // 性别
    'gender_list' => [
        1 => '男',
        2 => '女',
        3 => '未知',
    ],

    // 支付方式
    'pay_type' => [
        1 => '支付宝',
        2 => '微信',
        3 => '其他',
    ],

    // 菜单类型
    'menu_type' => [
        1 => '模块',
        2 => '导航',
        3 => '菜单',
        4 => '节点',
    ],

    // 菜单节点
    'menu_func' => [
        1 => [
            'name' => 'index',
            'title' => '查看',
            'checked' => true,
        ],
        2 => [
            'name' => 'add',
            'title' => '新增',
            'checked' => true,
        ],
        3 => [
            'name' => 'edit',
            'title' => '编辑',
            'checked' => true,
        ],
        4 => [
            'name' => 'drop',
            'title' => '删除',
            'checked' => true,
        ],
        5 => [
            'name' => 'detail',
            'title' => '详情',
            'checked' => false,
        ],
        6 => [
            'name' => 'copy',
            'title' => '复制',
            'checked' => false,
        ],
        7 => [
            'name' => 'cache',
            'title' => '缓存',
            'checked' => false,
        ],
        8 => [
            'name' => 'batchDrop',
            'title' => '批量删除',
            'checked' => false,
        ],
        9 => [
            'name' => 'batchCache',
            'title' => '批量缓存',
            'checked' => true,
        ],
    ],

    // 配置类型
    'config_type' => [
        'hidden' => '隐藏',
        'readonly' => '只读文本',
        'number' => '数字',
        'text' => '单行文本',
        'textarea' => '多行文本',
        'array' => '数组',
        'password' => '密码',
        'radio' => '单选框',
        'checkbox' => '复选框',
        'select' => '下拉框',
        'icon' => '字体图标',
        'date' => '日期',
        'datetime' => '时间',
        'image' => '单张图片',
        'images' => '多张图片',
        'file' => '单个文件',
        'files' => '多个文件',
        'ueditor' => '富文本编辑器',
        'json' => 'JSON',
    ],

    // 友链形式
    'link_form' => [
        1 => '文字链接',
        2 => '图片链接',
    ],

    // 友链平台
    'link_platform' => [
        1 => 'PC站',
        2 => 'WAP站',
        3 => '小程序',
        4 => 'APP应用',
    ],

    // 友链类型
    'link_type' => [
        1 => '友情链接',
        2 => '合作伙伴',
    ],

    // 站点类型
    'item_type' => [
        1 => '普通站点',
        2 => '其他',
    ],

    // 布局推荐类型
    'layout_type' => [
        1 => 'CMS文章',
        2 => '其他',
    ],

    // 广告平台
    'platform_type' => [
        1 => 'PC站',
        2 => 'WAP站',
        3 => '小程序',
        4 => 'APP应用',
    ],

    // 广告类型
    'ad_type' => [
        1 => '图片',
        2 => '文字',
        3 => '视频',
        4 => '其他',
    ],

    // 文章状态
    'article_status' => [
        1 => '待审核',
        2 => '已通过',
        3 => '未通过',
    ],

    // 切图类型
    'image_cut_type' => [
        1 => '文章切图',
        2 => '用户头像切图',
    ],

    // 定时任务类型
    'crontab_type' => [
        1 => '请求URL',
        2 => '执行SQL',
        3 => '执行Shell',
    ],

];
