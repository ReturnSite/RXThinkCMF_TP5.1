<?php

namespace app\admin\widget;

use app\admin\model\AdminDep as AdminDepModel;

/**
 * 部门-组件
 * @author 牧羊人
 * @date 2019/5/9
 * Class AdminDep
 * @package app\admin\widget
 */
class AdminDep extends AdminWidget
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/9
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AdminDepModel();
    }

    /**
     * 获取部门列表
     * @param string $name 字段名称
     * @param $selected_id 选择ID
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/9
     */
    public function complexSelect($name, $selected_id)
    {
        $dep_list = $this->model->getChilds(0, 1);
        $this->assign('name', $name);
        $this->assign("selected_id", $selected_id);
        $this->assign('dep_list', $dep_list);
        return $this->fetch('widget/admin_dep/complex_select');
    }
}
