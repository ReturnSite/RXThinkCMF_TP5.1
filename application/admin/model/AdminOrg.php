<?php

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 组织机构-模型
 * 
 * @author 牧羊人
 * @date 2019-05-07
 *
 */
class AdminOrg extends BaseModel
{
    // 设置数据表
    protected $table = 'think_admin_org';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-07
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
     * @date 2019-05-07
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::getInfo()
     */
    function getInfo($id)
    {
        $info = parent::getInfo($id, true);
        if ($info) {
            
            // 公司LOGO
            if ($info['logo']) {
                $info['logo_url'] = get_image_url($info['logo']);
            }
            
            // 获取城市
            if ($info['district_id']) {
                $city_model = new City();
                $city_name = $city_model->get_city_name($info['district_id'],">>",true);
                $info['city_name'] = $city_name;
            }
            
        }
        return $info;
    }
    
}