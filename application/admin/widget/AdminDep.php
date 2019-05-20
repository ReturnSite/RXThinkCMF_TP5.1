<?php

namespace app\admin\widget;

use app\admin\model\AdminDep as AdminDepModel;

/**
 * 部门-组件
 * 
 * @author 牧羊人
 * @date 2019-05-09
 *
 */
class AdminDep extends AdminWidget
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * (non-PHPdoc)
     * @see \app\admin\widget\AdminWidget::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new AdminDepModel();
    }
    
    /**
     * 获取部门列表
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * @param unknown $name 字段名称
     * @param unknown $selected_id 选择ID
     */
    function complex_select($name, $selected_id)
    {
        $dep_list = $this->model->getChilds(0,1);
        $this->assign('name', $name);
        $this->assign("selected_id", $selected_id);
        $this->assign('dep_list', $dep_list);
        return $this->fetch('widget/admin_dep/complex_select');
    }
    
}