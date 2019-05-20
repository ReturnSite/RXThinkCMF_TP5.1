<?php

namespace app\admin\controller;

use app\admin\model\AdSort as AdSortModel;
use app\admin\service\AdSortService;
use app\admin\validate\AdSort as AdSortValidate;

/**
 * 广告位-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-06
 *
 */
class Adsort extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-06
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new AdSortModel();
        $this->service = new AdSortService();
        $this->validate = new AdSortValidate();
    }
    
}