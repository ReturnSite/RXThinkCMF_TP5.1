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

namespace app\admin\service;

use app\admin\model\Menu as MenuModel;

/**
 * 菜单-服务类
 * 
 * @author 牧羊人
 * @date 2019-04-22
 *
 */
class MenuService extends BaseService
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * (non-PHPdoc)
     * @see \app\admin\service\AdminService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new MenuModel();
    }
    
    /**
     * 获取数据列表
     * 
     * @author 牧羊人
     * @date 2019-05-07
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::getList()
     */
    function getList()
    {
        $list = $this->model->getChilds(0);
        return message("操作成功", true, $list);
    }
    
    /**
     * 批量设置节点
     * 
     * @author 牧羊人
     * @date 2019-05-06
     */
    function batchFunc()
    {
        $data = request()->param();
        
        //菜单ID
        $menu_id = (int)$data['menu_id'];
        if (!$menu_id) {
            return message('菜单ID不能为空', false);
        }
        $info = $this->model->getInfo($menu_id);
        if (!$info) {
            return message('菜单信息不存在', false);
        }
        if ($info['type'] != 3) {
            return message('当前不是菜单,无法添加权限节点',false);
        }
        
        //菜单名称
        $name = trim($data['name']);
        if (!$name) {
            return message('菜单名称不能为空', false);
        }
        
        //节点数组
        $func = $data['func'];
        if (!$func) {
            return message('请选择权限节点',false);
        }
        $funcList = array_keys($func);
        
        $sortNum = 0;
        $totalNum = 0;
        foreach ($funcList as $val) {
            $sortNum++;
            $func_arr = explode('|', $val);
            
            // 节点名称
            $func_name = $func_arr[0];
            $func_title = $func_arr[1];
            
            // 获取已存在的
            $menu_info = $this->model->getOne([
                ['parent_id', '=', $menu_id],
                ['name', '=', $func_title],
                ['type', '=', 4],
            ]);
            $update_id = isset($menu_info['id']) ? $menu_info['id'] : 0;
            
            // 操作方法
            if ($func_name == 'add') {
                $func_name = 'edit';
            }
            
            // 更新数据源
            $item = [
                'id' => $update_id,
                'parent_id' => $menu_id,
                'name' => $func_arr[1],
                'type' => 4,
                'url' => "/" . ucfirst($name) . "/" . $func_name,
                'auth' => "sys:" . lcfirst($name) . ":{$func_name}",
                'sort' => $sortNum * 5,
            ];
            $result = $this->model->edit($item);
            if ($result) $totalNum++;
        }
        return message("本次共添加【{$totalNum}】个节点权限");
    }
    
    /**
     * 获取导航菜单
     * 
     * @author 牧羊人
     * @date 2019-04-22
     */
    function get_navbar_menu($system_auth)
    {
        if (!$system_auth) {
            return [];
        }

        $list1 = [];
        $list2 = [];
        $list3 = [];
        
        foreach ($system_auth as $key => $val) {
            if (count($val) <=0 ) continue;
            
            //查看节点状态
            if (is_array($val)) {
                $funcIds = implode(',', $val);
                $funcNum = $this->model->where([
                    'id' => array('in',$funcIds),
                    'is_show' => 1,
                ])->count();
                if ($funcNum<=0) continue;
            }
            
            $item = [];
            do{
                $info = $this->model->getInfo($key);
                if ($info && $info['is_show']==1) {
                    $info['title'] = $info['name'];
                    $info['font'] = "larry-icon";
                    $info['url'] = isset($info['to_url']) ? $info['to_url'] : '';
                    $item[] = $info;
                    $key = (int)$info['parent_id'];
                } else {
                    $key = 0;
                }
            } while ($key > 0);
            if (is_array($item) && count($item)>0) {
                $result = array_reverse($item);
            
                $item1 = $result[0];
                $item2 = $result[1];
                $item3 = $result[2];
            
                $list1[$item1['id']] = $item1;
                $list2[$item1['id']][$item2['id']] = $item2;
                $list3[$item2['id']][$item3['id']] = $item3;
            
            }
        }
        unset($key);
        unset($val);
        
        $list = [];
        
        // 菜单处理
        foreach ($list1 as $key => &$val) {
            $menuList2 = $list2[$key];
            if (!is_array($menuList2)) {
                continue;
            }
            foreach ($menuList2 as $kt => &$vt) {
                $menuList3 = $list3[$kt];
                if (!is_array($menuList3)) {
                    continue;
                }
                $menuList3 = array_merge($menuList3,array());
                $vt['children'] = $menuList3;
            }
            $menuList2 = array_merge($menuList2,array());
            $val['children'] = $menuList2;
            $list[] = $val;
        }
        $list = array_merge($list, array());
        
        return message("操作成功", true, $list);
    }
}