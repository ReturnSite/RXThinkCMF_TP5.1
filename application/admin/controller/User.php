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

use app\admin\model\User as UserModel;
use app\admin\service\UserService;
use app\admin\validate\User as UserValidate;

/**
 * 会员-控制器
 * @author 牧羊人
 * @date 2019/4/30
 * Class User
 * @package app\admin\controller
 */
class User extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/4/30
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new UserModel();
        $this->service = new UserService();
        $this->validate = new UserValidate();
    }

    /**
     * 设置状态
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/30
     */
    public function setStatus()
    {
        if (IS_POST) {
            $result = $this->service->setStatus();
            return $result;
        }
    }
}
