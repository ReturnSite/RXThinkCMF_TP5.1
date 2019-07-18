<?php
// +----------------------------------------------------------------------
// | RXThinkCMF框架 [ RXThinkCMF ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink.cn@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\widget;

use app\common\widget\BaseWidget;

/**
 * 复选框组件
 * @author 牧羊人
 * @date 2019/5/10
 * Class Checkbox
 * @package app\admin\widget
 */
class Checkbox extends BaseWidget
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }

    /**
     * 原始复选框组件
     * @param string $param 组件参数
     * @param array $list 数据源
     * @param array $checked_list 已选择数据
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function simpleSelect($param, $list = [], $checked_list = [])
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
     * @param string $param 组件参数
     * @param array $list 数据源
     * @param array $checked_list 已选择数据
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function complexSelect($param, $list = [], $checked_list = [])
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
