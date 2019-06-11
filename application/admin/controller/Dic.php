<?php

namespace app\admin\controller;

use app\admin\model\Dic as DicModel;
use app\admin\service\DicService;
use app\admin\validate\Dic as DicValidate;

/**
 * 字典-控制器
 * @author 牧羊人
 * @date 2019/5/9
 * Class Dic
 * @package app\admin\controller
 */
class Dic extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/9
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new DicModel();
        $this->service = new DicService();
        $this->validate = new DicValidate();
    }
}
