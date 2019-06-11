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

namespace app\common\widget;

use think\Controller;

/**
 * 组件基类
 * @author 牧羊人
 * @date 2019/4/4
 * Class BaseWidget
 * @package app\common\widget
 */
class BaseWidget extends Controller
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function initialize()
    {
        parent::initialize();

        // 取消模板布局
        $this->view->engine->layout(false);
    }
}
