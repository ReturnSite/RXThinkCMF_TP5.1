<?php

namespace app\admin\controller;

use app\admin\model\Hook as HookModel;
use app\admin\service\HookService;
use app\admin\validate\Hook as HookValidate;

/**
 * 钩子-控制器
 * @author 牧羊人
 * @date 2019/6/27
 * Class Hook
 * @package app\admin\controller
 */
class Hook extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/6/27
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new HookModel();
        $this->service = new HookService();
        $this->validate = new HookValidate();
    }
}
