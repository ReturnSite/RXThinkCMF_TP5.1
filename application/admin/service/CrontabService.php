<?php

namespace app\admin\service;

use app\admin\model\Crontab as CrontabModel;

/**
 * 定时任务-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-20
 *
 */
class CrontabService extends BaseService
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-20
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new CrontabModel();
    }
    
}