<?php

namespace app\admin\service;

use app\admin\model\LayoutDesc;

/**
 * 布局描述-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-05
 *
 */
class LayoutDescService extends BaseService
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-05
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new LayoutDesc();
    }
    
}