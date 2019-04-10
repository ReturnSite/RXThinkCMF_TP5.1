<?php
namespace app\admin\model;

use app\common\model\BaseModel;

class AdminDep extends BaseModel
{
    // 设置数据表
    protected $table = 'yk_admin_dep';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-04-09
     * (non-PHPdoc)
     * @see \app\common\model\CBaseModel::initialize()
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
     * @date 2019-04-09
     * (non-PHPdoc)
     * @see \app\common\model\CBaseModel::getInfo()
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