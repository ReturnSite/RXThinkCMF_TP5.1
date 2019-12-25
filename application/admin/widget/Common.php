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

/**
 * 公共组件
 * @author 牧羊人
 * @date 2019/5/10
 * Class Common
 * @package app\admin\widget
 */
class Common extends AdminWidget
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
     * switch组件
     * @param string $name 组件字段名称
     * @param string $title 组件标题
     * @param int $checked_id 已选择ID
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function switchCheck($name, $title, $checked_id)
    {
        $this->assign('name', $name);
        $this->assign('title', $title);
        $this->assign("checked_id", $checked_id);
        return $this->fetch("widget/switch_check");
    }

    /**
     * 单选框组件
     * @param string $param 组件参数
     * @param array $list 数据源
     * @param int $checked_id 已选择ID
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function radioCheck($param, $list, $checked_id)
    {
        $arr = explode('|', $param);

        // 参数
        $name = trim($arr[0]);
        $show_name = trim($arr[1]);
        $show_value = trim($arr[2]);

        if (is_array($list)) {
            $item = [];
            foreach ($list as $key => $val) {
                if (is_string($val)) {
                    $item[] = [
                        'show_value' => $key,
                        'show_name' => $val,
                        'checked' => $key == $checked_id,
                    ];
                } else {
                    $item[] = [
                        'show_value' => $val[$show_value],
                        'show_name' => $val[$show_name],
                        'checked' => $val[$show_value] == $checked_id,
                    ];
                }
            }
            // 重组后的数组赋值给list
            $list = $item;
        }
        $this->assign('name', $name);
        $this->assign('radio_list', $list);
        return $this->fetch("widget/radio_check");
    }

    /**
     * 下拉单选框组件
     * @param string $param 组件参数
     * @param array $list 数据源
     * @param int $selected_id 已选择ID
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function singleSelect($param, $list, $selected_id)
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
     * @param string $pinyin 拼音
     * @param string $code 编码
     * @return mixed|void
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function pinyin($pinyin, $code)
    {
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        if ($action == "getPinyin") {
            //TODO...
            return;
        }
        $this->assign('pinyin', $pinyin);
        $this->assign('code', $code);
        return $this->fetch("widget/pinyin");
    }

    /**
     * 提交按钮组件
     * @param string $param 组件参数
     * @param int $type 类型
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function submitBtn($param, $type = 2)
    {
        $param_arr = explode(',', $param);
        if (is_array($param_arr)) {
            foreach ($param_arr as $val) {
                $item = explode('|', $val);
                $this->assign('button_' . $item[0], $item[0]);
                $this->assign('button_' . $item[0] . '_title', $item[1]);
            }
        }
        $this->assign('button_type', $type);
        return $this->fetch("widget/submit_btn");
    }
}
