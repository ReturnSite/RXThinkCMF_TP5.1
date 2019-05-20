<?php

namespace app\admin\controller;

use think\Db;

/**
 * 数据库管理-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-16
 *
 */
class Database extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-16
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * 获取数据列表
     * 
     * @author 牧羊人
     * @date 2019-05-16
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::index()
     */
    function index()
    {
        if (IS_POST) {
            $list  = Db::query('SHOW TABLE STATUS');
            $list  = array_map('array_change_key_case', $list);
            $title = '数据备份';
            
            return $message = array(
                "msg"   => '操作成功',
                "code"  => 0 ,
                "data"  => $list,
                "count" => 10,
            );
        }
        return $this->fetch();
    }
    
    /**
     * 立即备份
     * 
     * @author 牧羊人
     * @date 2019-05-16
     */
    function backup()
    {
        
    }
    
    /**
     * 优化表
     * 
     * @author 牧羊人
     * @date 2019-05-16
     */
    function optimize()
    {
        
    }
    
    /**
     * 修复表
     * 
     * @author 牧羊人
     * @date 2019-05-16
     */
    function repair()
    {
        
    }
    
}