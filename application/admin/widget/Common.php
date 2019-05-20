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

namespace app\admin\widget;

/**
 * 常规组件
 * 
 * @author 牧羊人
 * @date 2019-04-22
 *
 */
class Common extends AdminWidget
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * (non-PHPdoc)
     * @see \app\admin\widget\AdminWidget::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * switch组件
     * 
     * @author 牧羊人
     * @date 2019-04-24
     */
    function switch_check($name, $title, $checked_id)
    {
        $this->assign('name', $name);
        $this->assign('title', $title);
        $this->assign("checked_id", $checked_id);
        return $this->fetch("widget/switch_check");
    }
    
    /**
     * 单选框组件
     * 
     * @author 牧羊人
     * @date 2019-05-10
     * @param unknown $name 属性名
     * @param unknown $value 属性值
     * @param unknown $title 属性标题
     * @param unknown $checked_id 选择记录ID
     */
    function radio_check($param, $list, $checked_id)
    {
        $arr = explode('|', $param);
        
        // 参数
        $name = trim($arr[0]);
        $show_name = trim($arr[1]);
        $show_value = trim($arr[2]);
        
        foreach ($list as &$val) {
            $val['show_value'] = $val[$show_value];
            $val['show_name'] = $val[$show_name];
            $val['checked'] = $val[$show_value] == $checked_id;
        }
        $this->assign('name', $name);
        $this->assign('radio_list', $list);
        return $this->fetch("widget/radio_check");
    }
    
    /**
     * 下拉单选框组件
     * 
     * @author 牧羊人
     * @date 2019-04-24
     */
    function single_select($param, $list, $selected_id)
    {
        $arr = explode('|', $param);
        
        //参数
        $name = $arr[0];
        $is_require = $arr[1];
        $show_tips = $arr[2];
        $show_name = $arr[3];
        $show_value = $arr[4];
        
        $this->assign('name', $name);
        $this->assign('is_require', $is_require);
        $this->assign('show_tips', $show_tips);
        $this->assign('show_name', $show_name);
        $this->assign('show_value', $show_value);
        $this->assign('data_list', $list);
        $this->assign("selected_id", $selected_id);
        return $this->fetch("widget/single_select");
    }
    
    /**
     * 拼音组件
     * 
     * @author 牧羊人
     * @date 2019-05-06
     */
    function pinyin($pinyin, $code)
    {
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        if($action == "getPinyin"){
            //TODO...
            return ;
        }
        $this->assign('pinyin', $pinyin);
        $this->assign('code', $code);
        return $this->fetch("widget/pinyin");
    }
    
    /**
     * 提交按钮组件
     * 
     * @author 牧羊人
     * @date 2019-05-10
     */
    function submitBtn($param, $type = 2)
    {
        $param_arr = explode(',', $param);
        if (is_array($param_arr)) {
            foreach ($param_arr as $val) {
                $item = explode('|', $val);
                $this->assign('button_' . $item[0], $item[0]);
                $this->assign('button_'. $item[0] .'_title', $item[1]);
            }
        }
        $this->assign('button_type', $type);
        return $this->fetch("widget/submit_btn");
    }
    
}