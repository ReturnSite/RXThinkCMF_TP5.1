<?php

namespace app\admin\controller;

use app\admin\model\Layout as LayoutModel;
use app\admin\service\LayoutService;
use app\admin\validate\Layout as LayoutValidate;

/**
 * 布局-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-06
 *
 */
class Layout extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-06
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new LayoutModel();
        $this->service = new LayoutService();
        $this->validate = new LayoutValidate();
    }
    
}