<?php

namespace app\admin\controller;

use app\admin\model\ImageCut as ImageCutModel;
use app\admin\service\ImageCutService;
use app\admin\validate\ImageCut as ImageCutValidate;

/**
 * 切图-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-09
 *
 */
class Imagecut extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new ImageCutModel();
        $this->service = new ImageCutService();
        $this->validate = new ImageCutValidate();
    }
    
}