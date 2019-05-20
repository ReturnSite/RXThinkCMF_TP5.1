<?php
// +----------------------------------------------------------------------
// | RXThink框架 [ RXThink ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 站点-模型
 * 
 * @author 牧羊人
 * @date 2019-04-30
 *
 */
class Item extends BaseModel
{
    // 设置数据表
    protected $table = 'think_item';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-04-30
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
     * @date 2019-04-30
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::getInfo()
     */
    function getInfo($id)
    {
        $info = parent::getInfo($id, true);
        if ($info) {
            
            // 站点图片
            if ($info['image']) {
                $info['image_url'] = get_image_url($info['image']);
            }
            
            // 站点类型
            if ($info['type']) {
                $info['type_name'] = config('config.item_type')[$info['type']]; 
            }
            
        }
        return $info;
    }
    
}