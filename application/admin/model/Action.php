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
 * 行为-模型
 * @author 牧羊人
 * @date 2019/5/14
 * Class Action
 * @package app\admin\model
 */
class Action extends BaseModel
{
    // 设置数据表
    protected $table = DB_PREFIX . 'action';

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/14
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }

    /**
     * 获取缓存信息
     * @param int $id
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/5/14
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id, true);
        if ($info) {
            // 来源类型
            if ($info['source_type']) {
                $info['source_type_name'] = config('config.action_source_type')[$info['source_type']];
            }
        }
        return $info;
    }
}
