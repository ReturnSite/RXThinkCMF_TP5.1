<?php

namespace app\admin\controller;

/**
 * Ajax异步请求接口
 * @author zongjl
 * @date 2019/6/20
 * Class Ajax
 * @package app\admin\controller
 */
class Ajax extends AdminBase
{
    public function getCateList()
    {
        $list = [];
        for ($i = 0; $i < 10; $i++) {
            $data = [
                'id' => $i,
                'name' => "云恒信息网络科技" . $i,
                'isParent' => true,
                'icon' => 'http://static.rxthink.com/admin/images/1_open.png',
                'open' => $i == 0 ? true : false,
                'children' => [
                    [
                        'id' => $i,
                        'name' => "技术中心1",
                        'isParent' => false,
                        'icon' => 'http://static.rxthink.com/admin/images/1_open.png',
                        'url' => '',
                    ],
                    [
                        'id' => $i,
                        'name' => "技术中心2",
                        'isParent' => false,
                        'icon' => 'http://static.rxthink.com/admin/images/1_open.png',
                        'url' => '',
                    ],
                    [
                        'id' => $i,
                        'name' => "技术中心3",
                        'isParent' => false,
                        'icon' => 'http://static.rxthink.com/admin/images/1_open.png',
                        'url' => '',
                    ],
                    [
                        'id' => $i,
                        'name' => "技术中心4",
                        'isParent' => false,
                        'icon' => 'http://static.rxthink.com/admin/images/1_open.png',
                        'url' => '',
                    ],
                    [
                        'id' => $i,
                        'name' => "技术中心5",
                        'isParent' => false,
                        'icon' => 'http://static.rxthink.com/admin/images/1_open.png',
                        'url' => '',
                    ]
                ],
            ];

            $list[] = $data;
        }
        return $list;
    }
}
