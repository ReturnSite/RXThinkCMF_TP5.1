<?php

namespace app\admin\controller;

use app\admin\model\Action as ActionModel;
use app\admin\service\ActionService;
use app\admin\validate\Action as ActionValidate;

/**
 * 行为-控制器
 * @author 牧羊人
 * @date 2019/5/14
 * Class Action
 * @package app\admin\controller
 */
class Action extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/14
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ActionModel();
        $this->service = new ActionService();
        $this->validate = new ActionValidate();
    }
}
