<?php

namespace app\admin\controller;

use app\admin\model\Admin as AdminModel;
use app\admin\service\AdminService;
use app\admin\validate\Admin as AdminValidate;
use app\admin\model\AdminRmr;
use app\admin\model\AdminRole;

/**
 * 人员-控制器
 * @author 牧羊人
 * @date 2019/5/10
 * Class Admin
 * @package app\admin\controller
 */
class Admin extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AdminModel();
        $this->service = new AdminService();
        $this->validate = new AdminValidate();
    }

    /**
     * 设置状态
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function setStatus()
    {
        if (IS_POST) {
            $result = $this->service->setStatus();
            return $result;
        }
    }

    /**
     * 设置角色
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function setRole()
    {
        if (IS_POST) {
            $result = $this->service->setRole();
            return $result;
        }

        // 人员ID
        $admin_id = request()->param('admin_id', 0);
        $this->assign('admin_id', $admin_id);

        // 获取全部角色
        $admin_role_model = new AdminRole();
        $list = $admin_role_model->field('id,name')->where(['mark' => 1])->select()->toArray();
        $this->assign('list', $list);

        // 获取人员角色
        $admin_rmr_model = new AdminRmr();
        $role_list = $admin_rmr_model->getColumn([
            'admin_id' => $admin_id,
            'mark' => 1,
        ], 'role_id');
        $this->assign('checked_list', $role_list);

        return $this->render();
    }

    /**
     * 重置密码
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/10
     */
    public function resetPwd()
    {
        if (IS_POST) {
            $result = $this->service->resetPwd();
            return $result;
        }
        // 记录ID
        $id = request()->param('id', 0);
        $this->assign('id', $id);
        return $this->render();
    }
}
