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
 * 菜单-模型
 * @author 牧羊人
 * @date 2019/4/21
 * Class Menu
 * @package app\admin\model
 */
class Menu extends BaseModel
{
    // 设置数据表
    protected $table = DB_PREFIX . 'menu';

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/4/21
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
     * @date 2019/4/21
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id, true);
        if ($info) {
            // 菜单类型
            if ($info['type']) {
                $info['type_name'] = config('config.menu_type')[$info['type']];
            }

            // 上级菜单
            if ($info['parent_id']) {
                $parent_info = $this->getInfo($info['parent_id']);
                $info['parent_name'] = $parent_info['name'];
            }

            // 菜单地址
            if ($info['type'] == 3) {
                $map = [
                    'parent_id' => $id,
                    'type' => 4,
                    'name' => "查看",
                    'is_show' => 1,
                    'mark' => 1,
                ];
                $result = $this->where($map)->find();
                if ($result) {
                    $info['to_url'] = $result['url'] . $result['param'];
                }
            }
        }
        return $info;
    }

    /**
     * 获取子级
     * @param int $parent_id 上级ID
     * @param bool $isMenu 是否菜单true或false
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/4/21
     */
    public function getChilds($parent_id = 0, $isMenu = true)
    {
        $map = [
            'parent_id' => $parent_id,
            'mark' => 1,
        ];
        $result = $this->where($map)->order("sort asc")->select();
        $list = [];
        if ($result) {
            foreach ($result as $val) {
                $id = (int)$val['id'];
                $info = $this->getInfo($id);
                if (!$info) {
                    continue;
                }
                $info['title'] = $info['name'];
                $info['font'] = "larry-icon";
                $itemList = $this->getChilds($id, $isMenu);
                $itemList = is_array($itemList) ? $itemList : [];
                if ($info['type'] == 3) {
                    if ($isMenu) {
                        $info['children'] = $itemList;
                    } else {
                        $info['funcList'] = $itemList;
                    }
                } else {
                    $info['children'] = $itemList;
                }
                $list[] = $info;
            }
        }
        return $list;
    }
}
