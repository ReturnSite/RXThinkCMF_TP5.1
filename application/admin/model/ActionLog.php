<?php

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 登录日志-模型
 * 
 * @author 牧羊人
 * @date 2019-05-14
 *
 */
class ActionLog extends BaseModel
{
    // 设置数据表
    protected $table = 'think_action_log';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-14
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
     * @date 2019-05-14
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