<?php

namespace app\admin\service;

use app\admin\model\AdminDep as AdminDepModel;

/**
 * 部门-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-07
 *
 */
class AdminDepService extends BaseService
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
        $this->model = new AdminDepModel();
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
        $list = $this->model->getChilds(0, 1);
        return message('操作成功', true, $list);
    }
    
}