<?php

namespace app\admin\service;

use app\admin\model\AdminOrg as AdminOrgModel;

/**
 * 组织机构-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-07
 *
 */
class AdminOrgService extends BaseService
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
        $this->model = new AdminOrgModel();
    }
    
    /**
     * 添加或编辑
     * 
     * @author 牧羊人
     * @date 2019-05-07
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::edit()
     */
    function edit()
    {
        $data = request()->param();
        
        // 公司LOGO
        $logo = trim($data['logo']);
        if (strpos($logo, "temp")) {
            $data['logo'] = save_image($logo, 'admin_org');
        }
        return parent::edit($data);
    }
    
}