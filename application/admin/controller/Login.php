<?php
namespace app\admin\controller;

class Login extends AdminBase
{
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    function index()
    {
        // 取消模板布局
        $this->view->engine->layout(false);
        return $this->fetch();
    }
    
}