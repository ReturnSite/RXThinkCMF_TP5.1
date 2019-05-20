<?php

namespace app\admin\controller;

/**
 * 错误-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-08
 *
 */
class Error extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-07
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * 错误页面
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::index()
     */
    function index()
    {
        return $this->render("public/404");
    }
    
}