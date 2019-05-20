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

namespace app\admin\widget;

use app\common\widget\BaseWidget;

/**
 * 后台挂件基类
 * 
 * @author 牧羊人
 * @date 2019-04-22
 *
 */
class AdminWidget extends BaseWidget
{
    // 模型、服务
    protected $model, $service;
    
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * (non-PHPdoc)
     * @see \app\common\widget\BaseWidget::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
}