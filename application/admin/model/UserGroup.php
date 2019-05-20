<?php

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 用户分组-模型
 * 
 * @author 牧羊人
 * @date 2019-05-08
 *
 */
class UserGroup extends BaseModel
{
    // 设置数据表
    protected $table = 'think_user_group';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::initialize()
     */
    function initialize()
    {
        parent::initialize();
    }
    
    /**
     * 获取缓存信息
     * 
     * @author 牧羊人
     * @date 2019-05-08
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