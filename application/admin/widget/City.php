<?php

namespace app\admin\widget;

use app\admin\model\City as CityModel;

/**
 * 城市组件
 * @author 牧羊人
 * @date 2019/5/10
 * Class City
 * @package app\admin\widget
 */
class City extends AdminWidget
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new CityModel();
    }

    /**
     * 常规组件
     * @param int $city_id 城市ID
     * @param int $limit 限制数
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function simpleSelect($city_id, $limit = 3)
    {
        $city_list = array(
            1 => array('tname' => '省', 'code' => 'province', 'list' => [], 'selected' => 0),
            2 => array('tname' => '市', 'code' => 'city', 'list' => [], 'selected' => 0),
            3 => array('tname' => '县/区', 'code' => 'district', 'list' => [], 'selected' => 0),
        );
        $info = $this->model->getInfo($city_id);
        $level = $info['level'];
        $city_list[1]['list'] = $this->model->getChilds(1);
        while ($level > 1) {
            $city_list[$level]['list'] = $this->model->getChilds($info['parent_id']);
            $city_list[$level]['selected'] = $info['id'];
            $info = $this->model->getInfo($info['parent_id']);
            $level--;
        }
        $city_list[1]['selected'] = $info['id'];
        $city_list = array_slice($city_list, 0, $limit);
        $this->assign('city_list', $city_list);
        return $this->fetch('widget/city/simple_select');
    }

    /**
     * 复杂组件
     * @param string $param 组件参数
     * @param int $select_id 已选择ID
     * @param int $limit 限制数
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function complexSelect($param, $select_id, $limit = 3)
    {
        $result = explode('|', $param);

        // 提示文字
        $show_tips = $result[0];
        // 是否必填
        $is_require = $result[1];
        // 层级数组
        $level = [
            1 => 'province',
            2 => 'city',
            3 => 'district',
        ];

        $city_name = $this->model->get_city_name($select_id, " ");
        $item = explode(' ', $city_name);

        $this->assign('show_tips', $show_tips);
        $this->assign('is_require', $is_require);
        $this->assign('level', $level[$limit]);
        $this->assign('item', $item);
        return $this->fetch('widget/city/complex_select');
    }
}
