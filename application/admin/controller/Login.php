<?php
// +----------------------------------------------------------------------
// | RXThink框架 [ RXThink ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\service\AdminService;

/**
 * 系统登录-控制器
 * 
 * @author 牧羊人
 * @date 2019-04-18
 */
class Login extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-04-18
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->service = new AdminService();
    }
    
    /**
     * 登录首页
     * 
     * @author 牧羊人
     * @date 2019-04-18
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::index()
     */
    function index()
    {
        // 取消模板布局
        $this->view->engine->layout(false);
        return $this->fetch();
    }
    
    /**
     * 系统登录
     * 
     * @author 牧羊人
     * @date 2019-04-18
     */
    function login()
    {
        if (IS_POST) {
            $result = $this->service->login();
            return $result;
        }
        if($_GET['do'] == 'exit') {
            session('admin_id', null);
            $this->redirect('/login/index');
        }
    }
    
}