<?php

namespace app\admin\widget;

use app\admin\model\AdminOrg as AdminOrgModel;
/**
 * 组织机构-组件
 * 
 * @author 模样人
 * @date 2019-05-09
 *
 */
class AdminOrg extends AdminWidget
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
        $this->model = new AdminOrgModel();
    }
    
    function select($param, $selected_id)
    {
        $item = explode('|', $param);
        
        //参数
        $name = $item[0];
        $is_require = $item[1];
        $show_tips = $item[2];
        $show_name = $item[3];
        $show_value = $item[4];
        
        //获取组织机构
        
        $result = $this->model->where(['mark' => 1])->field('id,name')->select();
        $data_list = [];
        foreach ($result as $val) {
            $data_list[] = [
                'id'    => $val['id'],
                'name'  => $val['name'],
            ];
        }
        $this->assign('name', $name);
        $this->assign('is_require', $is_require);
        $this->assign('show_tips', $show_tips);
        $this->assign('show_name', $show_name);
        $this->assign('show_value', $show_value);
        $this->assign('data_list', $data_list);
        $this->assign("selected_id", $selected_id);
        return $this->fetch('widget/single_select');
    }
    
}