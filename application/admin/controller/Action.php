<?php

namespace app\admin\controller;

use app\admin\model\Action as ActionModel;
use app\admin\service\ActionService;
use app\admin\validate\Action as ActionValidate;

/**
 * 行为-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-14
 *
 */
class Action extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-14
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new ActionModel();
        $this->service = new ActionService();
        $this->validate = new ActionValidate();
    }
    
}