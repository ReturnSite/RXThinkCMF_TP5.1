<?php

namespace app\admin\service;

use app\admin\model\City as CityModel;

/**
 * 城市-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-07
 *
 */
class CityService extends BaseService
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-07
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new CityModel();
    }
    
    /**
     * 获取数据列表
     * 
     * @author 牧羊人
     * @date 2019-05-07
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::getList()
     */
    function getList()
    {
        $list = $this->model->getAll();
        return message("操作成功", true, $list);
    }
    
}