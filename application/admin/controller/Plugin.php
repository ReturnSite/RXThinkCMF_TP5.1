<?php

namespace app\admin\controller;

use app\admin\model\Plugin as PluginModel;
use app\admin\service\PluginService;
use app\admin\validate\Plugin as PluginValidate;

/**
 * 插件-控制器
 * @author 牧羊人
 * @date 2019/6/27
 * Class Plugin
 * @package app\admin\controller
 */
class Plugin extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/6/27
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new PluginModel();
        $this->service = new PluginService();
        $this->validate = new PluginValidate();
    }
}
