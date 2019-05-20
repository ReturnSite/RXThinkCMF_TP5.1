<?php

namespace app\admin\service;

use app\admin\model\ActionLog as ActionLogModel;

/**
 * 登录日志-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-14
 *
 */
class ActionLogService extends BaseService
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2109-05-14
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new ActionLogModel();
    }
    
}