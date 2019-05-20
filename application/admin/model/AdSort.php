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
 * 广告位-模型
 * 
 * @author 牧羊人
 * @date 2019-04-30
 *
 */
class AdSort extends BaseModel
{
    // 设置数据表
    protected $table = 'think_ad_sort';
    
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
            
            // 获取站点
            if ($info['item_id']) {
                $item_model = new Item();
                $item_info = $item_model->getInfo($info['item_id']);
                $info['item_name'] = $item_info['name'];
            }
            
            // 获取栏目
            if ($info['cate_id']) {
                $item_cate_model = new ItemCate();
                $cate_name = $item_cate_model->getCateName($info['cate_id'], ">>");
                $info['cate_name'] = $cate_name;
            }
            
            // 使用平台
            if ($info['platform']) {
                $info['platform_name'] = config('config.platform_type')[$info['platform']];
            }
            
        }
        return $info;
    }
    
}