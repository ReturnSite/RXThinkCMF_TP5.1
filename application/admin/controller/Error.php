<?php

namespace app\admin\controller;

/**
 * 错误-控制器
 * @author 牧羊人
 * @date 2019/5/8
 * Class Error
 * @package app\admin\controller
 */
class Error extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/8
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }

    /**
     * 错误页面
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/8
     */
    public function index()
    {
        return $this->render("public/404");
    }
}
