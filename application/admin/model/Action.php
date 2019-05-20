<?php

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 行为-模型
 * 
 * @author 牧羊人
 * @date 2019-05-14
 * @author Administrator
 *
 */
class Action extends BaseModel
{
    // 设置数据表
    protected $table = 'think_action';
    
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