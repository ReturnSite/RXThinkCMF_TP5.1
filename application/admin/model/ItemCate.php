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
 * 栏目-模型
 * @author 牧羊人
 * @date 2019/4/30
 * Class ItemCate
 * @package app\admin\model
 */
class ItemCate extends BaseModel
{
    // 设置数据表
    protected $table = 'think_item_cate';

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
            // 栏目封面
            if ($info['cover']) {
                $info['cover_url'] = get_image_url($info['cover']);
            }

            // 上级栏目
            if ($info['parent_id']) {
                $parent_info = $this->getInfo($info['parent_id']);
                $info['parent_name'] = $parent_info['name'];
            }

            // 获取站点
            if ($info['item_id']) {
                $item_model = new Item();
                $item_info = $item_model->getInfo($info['item_id']);
                $info['item_name'] = $item_info['name'];
            }
        }
        return $info;
    }

    /**
     * 获取子级栏目
     * @param int $item_id 站点ID
     * @param int $parent_id 上级ID
     * @param bool $flag 是否获取子级
     * @return array 返回结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/4/30
     */
    public function getChilds($item_id = 0, $parent_id = 0, $flag = false)
    {
        $map = [
            'parent_id' => $parent_id,
            'mark' => 1,
        ];
        if ($item_id) {
            $map['item_id'] = $item_id;
        }
        $result = $this->where($map)->order("sort asc")->select();
        if ($result) {
            foreach ($result as $val) {
                $info = $this->getInfo($val['id']);
                if (!$info) {
                    continue;
                }
                if ($flag) {
                    $childList = $this->getChilds($item_id, $val['id'], 0);
                    $info['children'] = $childList;
                }
                $list[] = $info;
            }
        }
        return $list;
    }

    /**
     * 获取栏目名称
     * @param int $cate_id 栏目ID
     * @param string $delimiter 分隔符
     * @return string 返回结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/4/30
     */
    public function getCateName($cate_id, $delimiter = "")
    {
        do {
            $info = $this->getInfo($cate_id);
            $names[] = $info['name'];
            $cate_id = $info['parent_id'];
        } while ($cate_id > 0);
        $names = array_reverse($names);
        if (strpos($names[1], $names[0]) === 0) {
            unset($names[0]);
        }
        $nameStr = implode($delimiter, $names);
        return $nameStr;
    }
}
