<?php


namespace app\api\service;


use think\Model;

/**
 * 基类服务
 * Class BaseService
 * @package app\api\service
 */
class BaseService extends Model
{
    // 模型
    protected $model;
    // 验证类
    protected $validate;

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/8/28
     */
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * 分页参数设置
     * @param int $page 页码
     * @param int $perpage 每页数
     * @param string $limit 限制条数
     * @author 牧羊人
     * @date 2019/5/24
     */
    public function initPage(&$page, &$perpage, &$limit)
    {
        $page = (int)$_REQUEST['page'];
        $perpage = (int)$_REQUEST['perpage'];
        $page = $page ? $page : 1;
        $perpage = $perpage ? $perpage : 10;
        $startIndex = ($page - 1) * $perpage;
        $limit = "{$startIndex}, {$perpage}";
    }
}