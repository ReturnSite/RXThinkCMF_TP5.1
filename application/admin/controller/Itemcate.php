<?php

namespace app\admin\controller;

use app\admin\model\ItemCate as ItemCateModel;
use app\admin\service\ItemCateService;
use app\admin\validate\ItemCate as ItemCateValidate;
use app\admin\model\Item;

/**
 * 栏目-控制器
 * @author 牧羊人
 * @date 2019/5/5
 * Class Itemcate
 * @package app\admin\controller
 */
class Itemcate extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/5
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ItemCateModel();
        $this->service = new ItemCateService();
        $this->validate = new ItemCateValidate();
    }

    /**
     * 添加或编辑
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/5/5
     */
    public function edit()
    {
        $parent_id = request()->param('pid');
        if ($parent_id) {
            $parent_info = $this->model->getInfo($parent_id);
        }

        // 获取站点
        $item_model = new Item();
        $item_list = $item_model->where(['status' => 1, 'mark' => 1])->select();
        $this->assign('item_list', $item_list ? $item_list->toArray() : []);

        return parent::edit([
            'parent_id' => $parent_id,
            'parent_name' => isset($parent_info['name']) ? $parent_info['name'] : '',
        ]);
    }
}
