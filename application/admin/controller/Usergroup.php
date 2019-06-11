<?php

namespace app\admin\controller;

use app\admin\model\UserGroup as UserGroupModel;
use app\admin\service\UserGroupService;
use app\admin\validate\UserGroup as UserGroupValidate;

/**
 * 用户分组-控制器
 * @author 牧羊人
 * @date 2019/5/8
 * Class Usergroup
 * @package app\admin\controller
 */
class Usergroup extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/8
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new UserGroupModel();
        $this->service = new UserGroupService();
        $this->validate = new UserGroupValidate();
    }
}
