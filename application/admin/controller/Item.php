<?php

namespace app\admin\controller;

use app\admin\model\Item as ItemModel;
use app\admin\service\ItemService;
use app\admin\validate\Item as ItemValidate;

/**
 * 站点-控制器
 * @author 牧羊人
 * @date 2019/5/5
 * Class Item
 * @package app\admin\controller
 */
class Item extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/5
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ItemModel();
        $this->service = new ItemService();
        $this->validate = new ItemValidate();
    }
}
