<?php
// +----------------------------------------------------------------------
// | RXThink框架 [ RXThink ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\User as UserModel;
use app\admin\service\UserService;
use app\admin\validate\User as UserValidate;

/**
 * 会员-控制器
 * 
 * @author 牧羊人
 * @date 2019-04-29
 *
 */
class User extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-04-29
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new UserModel();
        $this->service = new UserService();
        $this->validate = new UserValidate();
    }
    
    /**
     * 设置状态
     * 
     * @author 牧羊人
     * @date 201-04-30
     */
    function setStatus()
    {
        if (IS_POST) {
            $result = $this->service->setStatus();
            return $result;
        }
    }
    
}