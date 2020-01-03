<?php
// +----------------------------------------------------------------------
// | RXThinkCMF框架 [ RXThinkCMF ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink.cn@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\service;

use app\admin\model\Config as ConfigModel;

/**
 * 配置-服务类
 * @author 牧羊人
 * @date 2019/4/24
 * Class ConfigService
 * @package app\admin\service
 */
class ConfigService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/4/24
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ConfigModel();
    }

    /**
     * 获取数据列表
     * @return array
     * @author 牧羊人
     * @date 2019/4/24
     */
    public function getList()
    {
        $param = request()->param();

        // 查询条件
        $map = [];

        // 配置分组ID
        $group_id = (int)$param['group_id'];
        if ($group_id) {
            $map[] = ['group_id', '=', $group_id];
        }

        return parent::getList($map);
    }
}
