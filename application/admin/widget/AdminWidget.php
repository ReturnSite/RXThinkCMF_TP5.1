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

namespace app\admin\widget;

use app\common\widget\BaseWidget;

/**
 * 后台挂件基类
 * @author 牧羊人
 * @date 2019/5/9
 * Class AdminWidget
 * @package app\admin\widget
 */
class AdminWidget extends BaseWidget
{
    // 模型
    protected $model;
    // 服务
    protected $service;

    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/9
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }
}
