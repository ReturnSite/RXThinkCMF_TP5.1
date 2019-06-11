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

namespace app\admin\controller;

use app\admin\model\Menu as MenuModel;
use app\admin\service\MenuService;
use app\admin\validate\Menu as MenuValidate;

// 临时设置最大内存占用为3G
ini_set('memory_limit', '3072M');
// 设置脚本最大执行时间 为0 永不过期
set_time_limit(0);

/**
 * 菜单-控制器
 * @author 牧羊人
 * @date 2019/4/21
 * Class Menu
 * @package app\admin\controller
 */
class Menu extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/4/21
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new MenuModel();
        $this->service = new MenuService();
        $this->validate = new MenuValidate();
    }

    /**
     * 添加或编辑
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/21
     */
    public function edit()
    {
        $menuList = $this->model->getChilds(0, false);
        if ($menuList) {
            $list = array();
            foreach ($menuList as $val) {
                $key = (int)$val['id'];
                $list[$key] = $val;
                $vlist = $val['children'];
                if ($vlist) {
                    foreach ($vlist as &$v) {
                        $k = (int)$v['id'];
                        $v['name'] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--" . $v['name'];
                        $list[$k] = $v;
                        $clist = $v['children'];
                        if ($clist) {
                            foreach ($clist as &$vt) {
                                $kt = (int)$vt['id'];
                                $vt['name'] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;|--" . $vt['name'];
                                $list[$kt] = $vt;
                            }
                        }
                    }
                }
            }
        }
        $this->assign('menu_list', $list);

        $pid = input("get.pid", 0);

        return parent::edit([
            'parent_id' => $pid,
            'is_show' => 1,
        ]);
    }

    /**
     * 批量设置节点
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/21
     */
    public function batchFunc()
    {
        if (IS_POST) {
            $result = $this->service->batchFunc();
            return $result;
        }
        $this->assign('menu_id', (int)$_GET['menu_id']);
        return $this->render();
    }

    /**
     * 获取系统图标
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/21
     */
    public function getSystemIcon()
    {
        return $this->render('system_icon');
    }

    /**
     * 获取导航菜单
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/21
     */
    public function getNavbarMenu()
    {
        $result = $this->service->getNavbarMenu($this->system_auth);
        return $result;
    }
}
