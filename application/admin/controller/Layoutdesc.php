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

namespace app\admin\controller;

use app\admin\model\LayoutDesc as LayoutDescModel;
use app\admin\service\LayoutDescService;
use app\admin\validate\LayoutDesc as LayoutDescValidate;

/**
 * 布局描述-控制器
 * @author 牧羊人
 * @date 2019/5/6
 * Class Layoutdesc
 * @package app\admin\controller
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
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/6
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new LayoutDescModel();
        $this->service = new LayoutDescService();
        $this->validate = new LayoutDescValidate();
    }

    /**
     * 获取子级
     * @return array
     * @author 牧羊人
     * @date 2019/5/6
     */
    public function getChilds()
    {
        if (IS_POST) {
            $item_id = request()->param('item_id');
            $list = $this->model->getChilds($item_id);
            return message('获取成功', true, $list);
        }
    }
}
