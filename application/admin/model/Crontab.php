<?php

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 定时任务-模型
 * 
 * @author 牧羊人
 * @date 2019-05-20
 *
 */
class Crontab extends BaseModel
{
    // 设置数据表
    protected $table = 'think_crontab';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-20
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * 获取缓存信息
     * 
     * @author 牧羊人
     * @date 2019-05-20
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::getInfo()
     */
    function getInfo($id)
    {
        $info = parent::getInfo($id);
        if ($info) {
            // TODO...
        }
        return $info;
    }
    
}