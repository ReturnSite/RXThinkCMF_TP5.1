<?php

namespace app\admin\service;

use app\admin\model\Plugin;

/**
 * 插件-服务类
 * @author 牧羊人
 * @date 2019/6/27
 * Class PluginService
 * @package app\admin\service
 */
class PluginService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/6/27
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new Plugin();
    }
}
