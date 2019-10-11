<?php

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 钩子-模型
 * @author 牧羊人
 * @date 2019/6/27
 * Class Hook
 * @package app\admin\model
 */
class Hook extends BaseModel
{
    // 设置数据表
    protected $table = DB_PREFIX . 'hook';

    // 钩子类型
    public $type = [
        1 => '系统钩子',
        2 => '插件钩子',
    ];
    // 钩子状态
    public $status = [
        1 => '在用',
        2 => '停用',
    ];

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/6/27
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }

    /**
     * 获取缓存信息
     * @param int $id 记录ID
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/6/27
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id, true);
        if ($info) {
            // TODO...
        }
        return $info;
    }
}
