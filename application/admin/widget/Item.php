<?php

namespace app\admin\widget;

use app\admin\model\ItemCate as ItemCateModel;
use app\admin\model\Item as ItemModel;

/**
 * 站点-组件
 * 
 * @author 牧羊人
 * @date 2019-05-06
 *
 */
class Item extends AdminWidget
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-06
     * (non-PHPdoc)
     * @see \app\admin\widget\AdminWidget::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new ItemCateModel();
    }
    
    /**
     * 站点选择组件
     * 
     * @author 牧羊人
     * @date 2019-05-06
     */
    function item_select($item_id, $cate_id=0, $limit = 1)
    {
        // 初始化组件
        $item_list = [
            1 => [
                'tname' => '站点',
                'code' => 'item',
                'list' => [],
            ],
            2 => [
                'tname' => '栏目',
                'code' => 'cate',
                'list' => [],
            ],
        ];
        
        // 获取栏目
        $result = $this->model->getChilds($item_id, 0, true);
        $cate_list = [];
        if (is_array($result)) {
            foreach ($result as $val) {
                $cate_list[] = [
                    'id'    => $val['id'],
                    'name'  => $val['name'],
                ];
                foreach ($val['children'] as $vt) {
                    $cate_list[] = [
                        'id'    =>$vt['id'],
                        'name'  =>"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--" . $vt['name'],
                    ];
                }
            }
        }
        $item_list[2]['list'] = $cate_list;
        $item_list[2]['selected'] = $cate_id;
        
        // 获取站点
        $item_model = new ItemModel();
        $list = $item_model->where(['status' => 1, 'mark' => 1])->select();
        $item_list[1]['list']  = $list ? $list->toArray() : [];
        $item_list[1]['selected'] = $item_id;
        
        // 数组处理
        $item_list = array_slice($item_list, 0, $limit);
        $this->assign('item_list', $item_list);
        
        return $this->fetch("widget/item/item_select");
    }
}