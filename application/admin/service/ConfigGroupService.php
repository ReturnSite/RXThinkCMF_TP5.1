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

namespace app\admin\service;

use app\admin\model\ConfigGroup as ConfigGroupModel;

/**
 * 配置分组-服务类
 * @author 牧羊人
 * @date 2019/4/24
 * Class ConfigGroupService
 * @package app\admin\service
 */
class ConfigGroupService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/4/24
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ConfigGroupModel();
    }
}
