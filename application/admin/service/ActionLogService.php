<?php

namespace app\admin\service;

use app\admin\model\ActionLog as ActionLogModel;

/**
 *  行为日志-服务类
 * @author 牧羊人
 * @date 2019/5/14
 * Class ActionLogService
 * @package app\admin\service
 */
class ActionLogService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/14
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ActionLogModel();
    }
}
