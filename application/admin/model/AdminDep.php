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
 * 部门-模型
 * @author 牧羊人
 * @date 2019/5/7
 * Class AdminDep
 * @package app\admin\model
 */
class AdminDep extends BaseModel
{
    // 设置数据表
    protected $table = 'think_admin_dep';

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/7
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
     * @date 2019/5/7
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id, true);
        if ($info) {
            // 获取上级部门
            if ($info['parent_id']) {
                $parent_info = $this->getInfo($info['parent_id']);
                $info['parent_name'] = $parent_info['name'];
            }

        }
        return $info;
    }

    /**
     * 获取子级
     * @param int $parent_id 上级ID
     * @param bool $flag 是否获取子级true或false
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function getChilds($parent_id = 0, $flag = false)
    {
        $list = [];
        $map = [
            'parent_id' => $parent_id,
            'mark' => 1,
        ];
        $result = $this->where($map)->order("sort asc")->select();
        if ($result) {
            foreach ($result as $val) {
                $id = (int)$val['id'];
                $info = $this->getInfo($id);
                if (!$info) {
                    continue;
                }
                if ($flag) {
                    $childList = $this->getChilds($id, 0);
                    $info['children'] = $childList;
                }
                $list[] = $info;
            }
        }
        return $list;
    }
}
