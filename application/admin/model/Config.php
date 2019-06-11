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

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 配置-模型
 * @author 牧羊人
 * @date 2019/4/24
 * Class Config
 * @package app\admin\model
 */
class Config extends BaseModel
{
    // 设置数据表
    protected $table = 'think_config';

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/4/24
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }

    /**
     * 获取缓存信息
     * @param int $id 记录ID
     * @return mixed 返回结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/4/24
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id, true);
        if ($info) {
            // 类型名称
            $info['type_name'] = config('config.config_type')[$info['type']];

            // 分组名称
            if ($info['group_id']) {
                $config_group_model = new ConfigGroup();
                $groupInfo = $config_group_model->getInfo($info['group_id']);
                $info['group_name'] = $groupInfo['name'];
            }
        }
        return $info;
    }
}
