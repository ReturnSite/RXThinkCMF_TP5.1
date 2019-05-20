<?php

namespace app\admin\controller;

use app\admin\model\Dictype as DictypeModel;
use app\admin\service\DictypeService;
use app\admin\validate\Dictype as DictypeValidate;

/**
 * 字典类型-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-09
 *
 */
class Dictype extends AdminBase
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
        $this->model = new DictypeModel();
        $this->service = new DictypeService();
        $this->validate = new DictypeValidate();
    }
    
}