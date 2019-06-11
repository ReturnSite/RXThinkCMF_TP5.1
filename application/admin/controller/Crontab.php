<?php

namespace app\admin\controller;

use app\admin\model\Crontab as CrontabModel;
use app\admin\service\CrontabService;
use app\admin\validate\Crontab as CrontabValidate;

/**
 * 定时任务-控制器
 * @author 牧羊人
 * @date 2019/5/20
 * Class Crontab
 * @package app\admin\controller
 */
class Crontab extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/20
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new CrontabModel();
        $this->service = new CrontabService();
        $this->validate = new CrontabValidate();
    }
}
