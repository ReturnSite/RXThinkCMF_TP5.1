<?php
// +----------------------------------------------------------------------
// | RXThinkCMF框架 [ RXThinkCMF ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink.cn@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 广告位-模型
 * @author zongjl
 * @date 2019/6/10
 * Class AdSort
 * @package app\admin\model
 */
class AdSort extends BaseModel
{
    // 设置数据表
    protected $table = DB_PREFIX . 'ad_sort';

    /**
     * 初始化模型
     * @author zongjl
     * @date 2019/6/10
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * 获取缓存信息
     * @param int $id 记录ID
     * @return mixed 返回结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author zongjl
     * @date 2019/6/10
     */
    public function getInfo($id)
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
