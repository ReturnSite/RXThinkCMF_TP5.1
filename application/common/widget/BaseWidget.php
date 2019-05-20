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

namespace app\common\widget;

use think\Controller;

/**
 * 挂件基类
 *
 * @author 牧羊人
 * @date 2019-04-04
 */
class BaseWidget extends Controller
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * (non-PHPdoc)
     * @see \think\Controller::initialize()
     */
    function initialize()
    {
        parent::initialize();
        
        // 取消模板布局
        $this->view->engine->layout(false);
    }
}