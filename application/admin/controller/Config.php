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

namespace app\admin\controller;

use app\admin\model\Config as ConfigModel;
use app\admin\service\ConfigService;
use app\admin\validate\Config as ConfigValidate;
use app\admin\model\ConfigGroup;

/**
 * 配置-控制器
 * @author 牧羊人
 * @date 2019/5/7
 * Class Config
 * @package app\admin\controller
 */
class Config extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ConfigModel();
        $this->service = new ConfigService();
        $this->validate = new ConfigValidate();
    }

    /**
     * 获取数据列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function index()
    {
        // 配置分组ID
        $group_id = request()->param('group_id', 1);

        // 获取配置分组
        $config_group_model = new ConfigGroup();
        $config_group_list = $config_group_model->where(['mark' => 1])->select();

        return parent::index([
            'group_id' => $group_id,
            'config_group_list' => $config_group_list->toArray(),
        ]);
    }

    /**
     * 添加或编辑
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function edit()
    {
        // 分组ID
        $group_id = request()->param('group_id', 0);
        return parent::edit([
            'group_id' => $group_id,
        ]);
    }
}
