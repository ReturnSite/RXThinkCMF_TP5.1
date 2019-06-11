<?php

namespace app\admin\controller;

use app\admin\model\AdminOrg as AdminOrgModel;
use app\admin\service\AdminOrgService;
use app\admin\validate\AdminOrg as AdminOrgValidate;

/**
 * 组织机构-控制器
 * @author 牧羊人
 * @date 2019/5/7
 * Class Adminorg
 * @package app\admin\controller
 */
class Adminorg extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AdminOrgModel();
        $this->service = new AdminOrgService();
        $this->validate = new AdminOrgValidate();
    }
}
