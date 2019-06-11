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

namespace app\admin\controller;

use app\admin\model\Position as PositionModel;
use app\admin\service\PositionService;
use app\admin\validate\Position as PositionValidate;

/**
 * 岗位-控制器
 * @author zongjl
 * @date 2019/6/10
 * Class Position
 * @package app\admin\controller
 */
class Position extends AdminBase
{
    /**
     * 初始化方法
     *
     * @author 牧羊人
     * @date 2019-04-24
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new PositionModel();
        $this->service = new PositionService();
        $this->validate = new PositionValidate();
    }
}
