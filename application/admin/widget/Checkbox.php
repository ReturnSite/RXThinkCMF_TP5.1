<?php

namespace app\admin\widget;

use app\common\widget\BaseWidget;

/**
 * 复选框组件
 * 
 * @author 牧羊人
 * @date 2019-05-10
 *
 */
class Checkbox extends BaseWidget
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-10
     * (non-PHPdoc)
     * @see \app\common\widget\BaseWidget::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * 原始复选框组件
     *
     * @author 牧羊人
     * @date 2019-05-10
     * @param unknown $param 参数
     * @param unknown $list 数据源
     * @param unknown $checked_id 已选择数组(数组)
     * @return \think\mixed
     */
    function simple_select($param, $list = [], $checked_list = [])
    {
        $arr = explode('|', $param);
    
        // 参数
        $name = trim($arr[0]);
        $show_name = trim($arr[1]);
        $show_value = trim($arr[2]);
    
        foreach ($list as &$val) {
            $val['show_value'] = $val[$show_value];
            $val['show_name'] = $val[$show_name];
            $val['checked'] = in_array($val['id'], $checked_list);
        }
        $this->assign('name', $name);
        $this->assign("simple_checkbox_list", $list);
        return $this->fetch("widget/checkbox/simple_checkbox");
    }
    
    /**
     * 复杂复选框组件
     * 
     * @author 牧羊人
     * @date 2019-05-10
     * @param unknown $param 参数
     * @param unknown $list 数据源
     * @param unknown $checked_list 已选择数组(数组)
     * @return \think\mixed
     */
    function complex_select($param, $list = [], $checked_list = [])
    {
        $arr = explode('|', $param);
        
        // 参数
        $name = trim($arr[0]);
        $show_name = trim($arr[1]);
        $show_value = trim($arr[2]);
        
        foreach ($list as &$val) {
            $val['show_value'] = $val[$show_value];
            $val['show_name'] = $val[$show_name];
            $val['checked'] = in_array($val['id'], $checked_list);
        }
        $this->assign('name', $name);
        $this->assign('complex_checkbox_list', $list);
        return $this->fetch("widget/checkbox/complex_checkbox");
    }
    
}