<?php


namespace app\script\service;

use app\script\model\Menu as MenuModel;
use app\script\model\Test;

class MenuService extends ScriptService
{
    /**
     * 初始化模型
     * @author zongjl
     * @date 2019/6/25
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new MenuModel();
    }

    /**
     * 更新菜单
     * @author zongjl
     * @date 2019/6/25
     */
    public function updateMenu()
    {
        $menu_model = new Test();
        $list = $menu_model->where([
            'parent_id' => 0,
            'mark' => 1,
        ])->order('sort', 'asc')->select()->toArray();
        if ($list) {
            foreach ($list as &$val) {
                $childs2 = $menu_model->where([
                    'parent_id' => $val['id'],
                    'mark' => 1,
                ])->order('sort', 'asc')->select()->toArray();
                $val['children'] = $childs2;

                if ($childs2) {
                    foreach ($val['children'] as &$val2) {
                        $childs3 = $menu_model->where([
                            'parent_id' => $val2['id'],
                            'mark' => 1,
                        ])->order('sort', 'asc')->select()->toArray();
                        $val2['children'] = $childs3;

                        if ($childs3) {
                            foreach ($val2['children'] as &$val3) {
                                $childs4 = $menu_model->where([
                                    'parent_id' => $val3['id'],
                                    'mark' => 1,
                                ])->order('sort', 'asc')->select()->toArray();
                                $val3['children'] = $childs4;
                            }
                        }
                    }
                }
            }
        }

        if ($list) {
            foreach ($list as $val) {
                unset($val['id']);
                $val['create_user'] = 1;
                $val['create_time'] = time();
                $menuId = $this->model->edit($val);
                if (!$menuId) {
                    continue;
                }
                foreach ($val['children'] as $val2) {
                    unset($val2['id']);
                    $val2['create_user'] = 1;
                    $val2['create_time'] = time();
                    $val2['parent_id'] = $menuId;
                    $menuId2 = $this->model->edit($val2);
                    if (!$menuId2) {
                        continue;
                    }

                    foreach ($val2['children'] as $val3) {
                        unset($val3['id']);
                        $val3['create_user'] = 1;
                        $val3['create_time'] = time();
                        $val3['parent_id'] = $menuId2;
                        $menuId3 = $this->model->edit($val3);
                        if (!$menuId3) {
                            continue;
                        }

                        foreach ($val3['children'] as $val4) {
                            unset($val4['id']);
                            $val4['create_user'] = 1;
                            $val4['create_time'] = time();
                            $val4['parent_id'] = $menuId3;
                            $this->model->edit($val4);
                        }
                    }
                }
            }
        }
    }
}
