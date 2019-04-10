<?php
namespace app\admin\controller;

use app\admin\model\Admin as AdminModel;

class Index extends AdminBase
{
    function initialize()
    {
        parent::initialize();
        $this->model = new AdminModel();
    }
    
    function index()
    {
        // 取消模板布局
        $this->view->engine->layout(false);
        return $this->fetch();
    }
    
}