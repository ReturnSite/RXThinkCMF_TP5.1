<?php

namespace app\admin\controller;

use app\admin\model\UserGroup as UserGroupModel;
use app\admin\service\UserGroupService;
use app\admin\validate\UserGroup as UserGroupValidate;

/**
 * 用户分组-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-08
 *
 */
class Usergroup extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new UserGroupModel();
        $this->service = new UserGroupService();
        $this->validate = new UserGroupValidate();
    }
    
    function uploadFile()
    {
        print_r("11");exit;
    }
    
}