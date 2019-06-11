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
 * 布局描述-模型
 * @author 牧羊人
 * @date 2019/4/30
 * Class LayoutDesc
 * @package app\admin\model
 */
class LayoutDesc extends BaseModel
{
    // 设置数据表
    protected $table = 'think_layout_desc';

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
            // 获取站点信息
            if ($info['page_id']) {
                $item_model = new Item();
                $item_info = $item_model->getInfo($info['page_id']);
                $info['page_name'] = $item_info['name'];
            }
        }
        return $info;
    }

    /**
     * 获取子级
     * @param $item_id 站点ID
     * @return array 返回结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/4/30
     */
    public function getChilds($item_id)
    {
        $result = $this->where(['page_id' => $item_id, 'mark' => 1])->order("sort asc")->select();
        $list = [];
        if ($result) {
            foreach ($result as $val) {
                $info = $this->getInfo($val['id']);
                $list[] = $info;
            }
        }
        return $list;
    }
}
