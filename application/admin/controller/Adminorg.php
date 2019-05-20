<?php

namespace app\admin\controller;

use app\admin\model\AdminOrg as AdminOrgModel;
use app\admin\service\AdminOrgService;
use app\admin\validate\AdminOrg as AdminOrgValidate;

/**
 * 组织机构-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-07
 *
 */
class Adminorg extends AdminBase
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
        $this->model = new AdminOrgModel();
        $this->service = new AdminOrgService();
        $this->validate = new AdminOrgValidate();
    }
    
}