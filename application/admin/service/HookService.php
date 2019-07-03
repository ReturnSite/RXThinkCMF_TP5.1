<?php

namespace app\admin\service;

use app\admin\model\Hook as HookModel;

/**
 * 钩子-服务类
 * @author 牧羊人
 * @date 2019/6/27
 * Class HookService
 * @package app\admin\service
 */
class HookService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/6/27
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new HookModel();
    }
}
