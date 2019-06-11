<?php

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 定时任务-模型
 * @author 牧羊人
 * @date 2019/5/20
 * Class Crontab
 * @package app\admin\model
 */
class Crontab extends BaseModel
{
    // 设置数据表
    protected $table = 'think_crontab';

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/20
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
     * @date 2019/5/20
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id);
        if ($info) {
            // TODO...
        }
        return $info;
    }
}
