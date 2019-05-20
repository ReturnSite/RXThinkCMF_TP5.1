<?php

namespace app\admin\service;

use app\admin\model\Dictype as DictypeModel;

/**
 * 字典类型-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-09
 *
 */
class DictypeService extends BaseService
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
        $this->model = new DictypeModel();
    }
    
}