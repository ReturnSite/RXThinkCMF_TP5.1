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

use app\admin\model\AdminRole as AdminRoleModel;
use app\admin\service\AdminRoleService;
use app\admin\validate\AdminRole as AdminRoleValidate;

/**
 * 角色-控制器
 * @author 牧羊人
 * @date 2019/4/22
 * Class Adminrole
 * @package app\admin\controller
 */
class Adminrole extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AdminRoleModel();
        $this->service = new AdminRoleService();
        $this->validate = new AdminRoleValidate();
    }
}
