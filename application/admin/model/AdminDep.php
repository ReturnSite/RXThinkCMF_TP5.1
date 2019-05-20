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

class AdminDep extends BaseModel
{
    // 设置数据表
    protected $table = 'think_admin_dep';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-04-09
     * (non-PHPdoc)
     * @see \app\common\model\CBaseModel::initialize()
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
     * @date 2019-04-09
     * (non-PHPdoc)
     * @see \app\common\model\CBaseModel::getInfo()
     */
    function getInfo($id)
    {
        $info = parent::getInfo($id);
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
     * 
     * @author 牧羊人
     * @date 2019-05-07
     * @param number $parent_id 上级部门ID
     * @param string $flag
     * @return unknown
     */
    function getChilds($parent_id = 0, $flag = false)
    {
        $map = [
            'parent_id' =>$parent_id,
            'mark' =>1,
        ];
        $result = $this->where($map)->order("sort asc")->select();
        if ($result) {
            foreach ($result as $val) {
                $id = (int)$val['id'];
                $info = $this->getInfo($id);
                if (!$info) continue;
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