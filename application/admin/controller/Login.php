<?php
// +----------------------------------------------------------------------
// | RXThinkCMF框架 [ RXThinkCMF ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink.cn@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\service\AdminService;

/**
 * 系统登录-控制器
 * @author 牧羊人
 * @date 2019/4/18
 * Class Login
 * @package app\admin\controller
 */
class Login extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/4/18
     */
    public function initialize()
    {
        parent::initialize();
        $this->service = new AdminService();
    }

    /**
     * 登录首页
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/18
     */
    public function index()
    {
        // 取消模板布局
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    /**
     * 系统登录
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/18
     */
    public function login()
    {
        if (IS_POST) {
            $result = $this->service->login();
            return $result;
        }
        if ($_GET['do'] == 'exit') {
            session('admin_id', null);
            $this->redirect('/login/index');
        }
    }
}
