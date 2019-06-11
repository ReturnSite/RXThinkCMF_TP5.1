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

use app\admin\model\City as CityModel;

/**
 * 城市-服务类
 * @author 牧羊人
 * @date 2019/5/7
 * Class CityService
 * @package app\admin\service
 */
class CityService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new CityModel();
    }

    /**
     * 获取数据列表
     * @return array
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function getList()
    {
        $list = $this->model->getAll();
        return message("操作成功", true, $list);
    }
}
