<?php

namespace app\admin\service;

use app\admin\model\Dic as DicModel;

/**
 * 字典-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-09
 *
 */
class DicService extends BaseService
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new DicModel();
    }
    
}