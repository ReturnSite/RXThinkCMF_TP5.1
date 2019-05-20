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
 * 菜单模型
 * 
 * @author 牧羊人
 * @date 2019-04-21
 *
 */
class Menu extends BaseModel
{
    // 设置数据表
    protected $table = 'think_menu';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-04-21
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
     * @date 2019-04-21
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::getInfo()
     */
    function getInfo($id)
    {
        $info = parent::getInfo($id);
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
                    'type'      =>4,
                    'name'      =>"查看",
                    'is_show'   =>1,
                    'mark'      =>1,
                ];
                $result = $this->where($map)->find();
                if($result) {
                    $info['to_url'] = $result['url'] . $result['param'];
                }
            }
            
        }
        return $info;
    }
    
    /**
     * 获取子级
     * 
     * @author 牧羊人
     * @date 2019-05-07
     */
    function getChilds($parent_id = 0, $is_menu=true)
    {
        $map = [
            'parent_id' => $parent_id,
            'mark'      => 1,
        ];
        $result = $this->where($map)->order("sort asc")->select();
        $list = [];
        if ($result) {
            foreach ($result as $val) {
                $id = (int)$val['id'];
                $info = $this->getInfo($id);
                if (!$info) continue;
                $info['title'] = $info['name'];
                $info['font'] = "larry-icon";
                $childs_list = $this->getChilds($id, $is_menu);
                if ($childs_list) {
                    if ($info['type'] == 3) {
                        if ($is_menu) {
                            $info['children'] = $childs_list;
                        } else {
                            $info['funcList'] = $childs_list;
                        }
                    } else {
                        $info['children'] = $childs_list;
                    }
                }
                $list[] = $info;
            }
        }
        return $list;
    }
    
}