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

if (!function_exists('make_option')) {

    /**
     * 下拉选择框组件
     * @param array $data 下拉框数据源
     * @param int $selected 选择数据ID
     * @param string $text_field 显示名称(支持多字段显示)
     * @param string $val_field 显示值
     * @author 牧羊人
     * @date 2019/4/28
     */
    function make_option($data, $selected = 0, $text_field = 'name', $val_field = 'id')
    {
        $result = '';
        $fields_arr = explode(',', $text_field);
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $show_text = '';
                if (is_array($val)) {
                    foreach ($fields_arr as $field) {
                        $show_text .= $val[$field] . ' ';
                    }
                    $show_text = substr($show_text, 0, -1);
                    $val_field && $key = $val[$val_field];
                } else {
                    $show_text = $val;
                }
                $sel = '';
                if ($selected && $key == $selected) {
                    $sel = 'selected';
                }
                $result .= '<option value = ' . $key . ' ' . $sel . '>' . $show_text . '</option>';
            }
        }
        echo $result;
    }
}

if (!function_exists('make_checkbox')) {

    /**
     * 复选框组件
     * @param array $data 数据源
     * @param string $name 组件名称
     * @param array $checked_array 已选中的数据
     * @param string $text_field 字段名
     * @param string $val_field 字段值
     * @param int $show_num 每行个数
     * @return string 返回结果
     * @author 牧羊人
     * @date 2019/4/28
     */
    function make_checkbox($data, $name, $checked_array = [], $text_field = '', $val_field = '', $show_num = 1)
    {
        $result = '';
//        $num = 0;
        foreach ($data as $key => $val) {
//            if ($num % $show_num == 0) {
//                $result .= '<div class="form-inline">';
//            }
            if (is_array($val)) {
                $value = $val[$val_field];
                $title = $val[$text_field];
            } else {
                $value = $key;
                $title = $val;
            }
            $checked = '';
            if (in_array($value, $checked_array)) {
                $checked = 'checked';
            }
            $result .= '<input name="' . $name . '[]" lay-skin="primary" title="' . $title . '" value="' . $value . '" '
                . $checked . ' type="checkbox">';
//            $num++;
//            if ($num % $show_num == 0) {
//                $result .= '</div>';
//            }
        }
//        //最后一个DIV 补全
//        if ($num % $show_num != 0) {
//            $result .= '</div>';
//        }
        echo $result;
    }
}

if (!function_exists('make_radio')) {

    /**
     * 单选框组件
     * @param array $data 数据源
     * @param string $name 组件名称
     * @param string $checked 已选中的值
     * @param string $text_field 字段名
     * @param string $val_field 字段值
     * @param int $show_num 每行显示数
     * @author 牧羊人
     * @date 2019/4/28
     */
    function make_radio($data, $name = '', $checked = '', $text_field = '', $val_field = '', $show_num = 10)
    {
        $result = '';
        $num = 0; // 计算器
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $show_name = $name;
                $show_id = $name . '_' . $key;
                if (is_array($val)) {
                    $value = $val[$val_field];
                    $title = $val[$text_field];
                } else {
                    $value = $key;
                    $title = $val;
                }
                $selected = '';
                if ($key == $checked) {
                    $selected = 'checked="checked"';
                }
                $result .= '<input name="' . $show_name . '" id="' . $show_id . '" value="' . $value
                    . '" title="' . $title . '" ' . $selected . ' type="radio" lay-filter="' . $show_name . '"/>';

                // 计数器+1
                $num++;
                if ($num % $show_num == 0) {
                    $result .= '<br>';
                }
            }
        }
        echo $result;
    }
}
