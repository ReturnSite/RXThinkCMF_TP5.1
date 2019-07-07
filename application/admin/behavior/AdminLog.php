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

namespace app\admin\behavior;

use app\admin\model\ActionLog;

/**
 * 后台登录日志
 * @author 牧羊人
 * @date 2019/4/4
 * Class AdminLog
 * @package app\admin\behavior
 */
class AdminLog
{
    /**
     * 执行行为 run方法是Behavior唯一的接口
     * @param $params 参数
     * @author 牧羊人
     * @date 2019/4/4
     */
    public function run($params)
    {
        if (IS_POST) {
            // 记录行为日志(登录后记录)
            ActionLog::record($params);
        }

//        // 使用方法
//        AdminLog::setTitle('登录');
//        Hook::listen('admin_login_init', $this->request);
    }
}
