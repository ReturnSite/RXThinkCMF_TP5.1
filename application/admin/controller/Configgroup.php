<?php
// +----------------------------------------------------------------------
// | RXThink框架 [ RXThink ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\ConfigGroup as ConfigGroupModel;
use app\admin\service\ConfigGroupService;
use app\admin\validate\ConfigGroup as ConfigGroupValidate;

/**
 * 配置分组-控制器
 * @author 牧羊人
 * @date 2019/4/24
 * Class Configgroup
 * @package app\admin\controller
 */
class Configgroup extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/4/24
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ConfigGroupModel();
        $this->service = new ConfigGroupService();
        $this->validate = new ConfigGroupValidate();
    }
}
