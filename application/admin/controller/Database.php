<?php
// +----------------------------------------------------------------------
// | RXThinkCMF框架 [ RXThinkCMF ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink.cn@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use think\Db;

/**
 * 数据库管理-控制器
 * @author 牧羊人
 * @date 2019/5/16
 * Class Database
 * @package app\admin\controller
 */
class Database extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/16
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }

    /**
     * 获取数据列表
     * @return array|mixed
     * @author 牧羊人
     * @date 2019/5/16
     */
    public function index()
    {
        if (IS_POST) {
            $list = Db::query('SHOW TABLE STATUS');
            $list = array_map('array_change_key_case', $list);
            $title = '数据备份';

            return $message = array(
                "msg" => '操作成功',
                "code" => 0,
                "data" => $list,
                "count" => 10,
            );
        }
        return $this->fetch();
    }

    /**
     * 立即备份
     * @author 牧羊人
     * @date 2019/5/16
     */
    public function backup()
    {
    }

    /**
     * 优化表
     * @author 牧羊人
     * @date 2019/5/16
     */
    public function optimize()
    {
    }
    
    /**
     * 修复表
     * @author 牧羊人
     * @date 2019/5/16
     */
    public function repair()
    {
    }
}
