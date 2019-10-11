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
 * 站点-模型
 * @author 牧羊人
 * @date 2019/4/30
 * Class Item
 * @package app\admin\model
 */
class Item extends BaseModel
{
    // 设置数据表
    protected $table = DB_PREFIX . 'item';

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/4/30
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
     * @author 牧羊人
     * @date 2019/4/30
     */
    public function getInfo($id)
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
