<?php

namespace app\admin\controller;

use app\admin\service\AdminAuthService;

/**
 * 权限设置-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-15
 *
 */
class Adminauth extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-15
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->service = new AdminAuthService();
    }
    
    /**
     * 获取数据列表
     * 
     * @author 牧羊人
     * @date 2019-05-15
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::index()
     */
    function index()
    {
        if (IS_POST) {
            $result = $this->service->getList();
            return $result;
        }
        
        // 参数
        $type = request()->param("type", 0);
        $type_id = request()->param("type_id", 0);
        $this->assign('type', $type);
        $this->assign('type_id', $type_id);
        return $this->fetch();
    }
    
    /**
     * 设置权限
     * 
     * @author 牧羊人
     * @date 2019-05-15
     */
    function setAuth()
    {
        if (IS_POST) {
            $result = $this->service->setAuth();
            return $result;
        }
    }
    
}