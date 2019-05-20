<?php

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 字典-模型
 * 
 * @author 牧羊人
 * @date 2019-05-09
 *
 */
class Dic extends BaseModel
{
    // 设置数据表
    protected $table = 'think_dic';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-09
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
     * @date 2019-05-09
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