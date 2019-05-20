<?php

namespace app\admin\service;

use app\admin\model\AdSort as AdSortModel;

/**
 * 广告位-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-06
 *
 */
class AdSortService extends BaseService
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-06
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new AdSortModel();
    }
    
}