<?php

namespace app\admin\controller;

use app\admin\model\LayoutDesc as LayoutDescModel;
use app\admin\service\LayoutDescService;
use app\admin\validate\LayoutDesc as LayoutDescValidate;

/**
 * 布局描述-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-05
 *
 */
class Layoutdesc extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-05
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new LayoutDescModel();
        $this->service = new LayoutDescService();
        $this->validate = new LayoutDescValidate();
    }
    
    /**
     * 获取子级
     * 
     * @author 牧羊人
     * @date 2019-05-06
     */
    function getChilds()
    {
        if (IS_POST) {
            $item_id = request()->param('item_id');
            $list = $this->model->getChilds($item_id);
            return message('获取成功', true, $list);
        }
    }
    
}