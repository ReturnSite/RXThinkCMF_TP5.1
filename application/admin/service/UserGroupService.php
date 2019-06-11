<?php

namespace app\admin\service;

use app\admin\model\UserGroup as UserGroupModel;

/**
 * 用户分组-服务类
 * @author 牧羊人
 * @date 2019/5/8
 * Class UserGroupService
 * @package app\admin\service
 */
class UserGroupService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/8
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new UserGroupModel();
    }
}

