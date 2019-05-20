<?php

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 切图-模型
 * 
 * @author 牧羊人
 * @date 2019-05-09
 * @author Administrator
 *
 */
class ImageCut extends BaseModel
{
    // 设置数据表
    protected $table = "think_image_cut";
    
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
    function getInfo($id) {
        $info = parent::getInfo($id);
        if ($info) {
            
            // 切图类型
            if ($info['type']) {
                $info['type_name'] = config('config.image_cut_type')[$info['type']];
            }
            
        }
        return $info;
    }
    
}