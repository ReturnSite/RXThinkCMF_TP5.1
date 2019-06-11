<?php

namespace app\admin\controller;

use app\admin\model\ImageCut as ImageCutModel;
use app\admin\service\ImageCutService;
use app\admin\validate\ImageCut as ImageCutValidate;

/**
 * 切图-控制器
 * @author 牧羊人
 * @date 2019/5/9
 * Class Imagecut
 * @package app\admin\controller
 */
class Imagecut extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/9
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ImageCutModel();
        $this->service = new ImageCutService();
        $this->validate = new ImageCutValidate();
    }
}
