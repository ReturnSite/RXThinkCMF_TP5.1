<?php
namespace app\common\service;

use think\Model;

/**
 * 基类服务
 * 
 * @author 牧羊人
 * @date 2019-04-10
 *
 */
class BaseService extends Model
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-04-10
     * (non-PHPdoc)
     * @see \think\Model::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
}