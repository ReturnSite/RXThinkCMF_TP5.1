<?php

namespace app\admin\controller;

use app\admin\model\ActionLog as ActionLogModel;
use app\admin\service\ActionLogService;
use app\admin\validate\ActionLog as ActionLogValidate;

/**
 * 行为日志-控制器
 * @author 牧羊人
 * @date 2019/5/14
 * Class Actionlog
 * @package app\admin\controller
 */
class Actionlog extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/14
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ActionLogModel();
        $this->service = new ActionLogService();
        $this->validate = new ActionLogValidate();
    }
}
