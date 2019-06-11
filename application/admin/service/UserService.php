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

namespace app\admin\service;

use app\admin\model\User as UserModel;

/**
 * 会员-服务类
 * @author 牧羊人
 * @date 2019/4/29
 * Class UserService
 * @package app\admin\service
 */
class UserService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/4/29
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new UserModel();
    }

    /**
     * 设置状态
     * @return array
     * @author 牧羊人
     * @date 2019/4/29
     */
    public function setStatus()
    {
        $data = request()->param();
        if (!$data['id']) {
            return message('会员ID不能为空', false);
        }
        if (!$data['status']) {
            return message('会员状态不能为空', false);
        }
        return parent::edit($data);
    }
}
