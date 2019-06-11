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
 * 布局-模型
 * @author 牧羊人
 * @date 2019/4/30
 * Class Layout
 * @package app\admin\model
 */
class Layout extends BaseModel
{
    // 设置数据表
    protected $table = 'think_layout';

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
            // 获取图片
            if ($info['image']) {
                $info['image_url'] = get_image_url($info['image']);
            }

            // 类型名称
            if ($info['type']) {
                $info['type_name'] = config('config.layout_type')[$info['type']];
            }

            // 推荐类型
            if ($info['type'] == 1) {
                // CMS文章

            } else {
                // TODO...
            }

            // 页面位置
            if ($info['page_id']) {
                $item_model = new Item();
                $item_info = $item_model->getInfo($info['page_id']);
                $info['page_name'] = $item_info['name'];
            }

            // 页面编号
            $layout_desc_model = new LayoutDesc();
            $layout_desc_info = $layout_desc_model->where([
                'page_id' => $info['page_id'],
                'loc_id' => $info['loc_id'],
            ])->find();
            if ($layout_desc_info) {
                $info['loc_name'] = $layout_desc_info['loc_desc'] . "=>" . $layout_desc_info['loc_id'];
            }
        }
        return $info;
    }
}
