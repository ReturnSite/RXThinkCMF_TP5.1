<?php

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 插件-模型
 * @author 牧羊人
 * @date 2019/6/27
 * Class Plugin
 * @package app\admin\model
 */
class Plugin extends BaseModel
{
    // 设置数据表
    protected $table = DB_PREFIX . 'plugin';

    // 插件类型
    public $type = [
        1 => '免费插件',
        2 => '收费插件',
    ];
    // 插件状态
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
        return parent::getInfo($id, true);
    }
}
