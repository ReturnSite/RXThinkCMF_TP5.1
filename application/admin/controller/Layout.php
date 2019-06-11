<?php

namespace app\admin\controller;

use app\admin\model\Layout as LayoutModel;
use app\admin\service\LayoutService;
use app\admin\validate\Layout as LayoutValidate;

/**
 * 布局-控制器
 * @author 牧羊人
 * @date 2019/5/6
 * Class Layout
 * @package app\admin\controller
 */
class Layout extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/6
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new LayoutModel();
        $this->service = new LayoutService();
        $this->validate = new LayoutValidate();
    }
}
