<?php

namespace app\admin\service;

use app\admin\model\Action as ActionModel;

/**
 * 行为-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-14
 *
 */
class ActionService extends BaseService
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-14
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new ActionModel();
    }
    
    /**
     * 获取数据列表
     * 
     * @author 牧羊人
     * @date 2019-05-15
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::getList()
     */
    function getList()
    {
        $param = request()->param();
        
        // 查询
        $map = [];
        
        // 来源类型
        $source_type = (int)$param['source_type'];
        if ($source_type) {
            $map[] = ['source_type', '=', $source_type];
        }
        
        return parent::getList($map);
    }
    
}