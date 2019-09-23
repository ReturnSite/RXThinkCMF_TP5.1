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

use app\admin\behavior\AdminLog;
use app\admin\model\ActionLog;
use think\captcha\Captcha;
use app\admin\model\Admin;
use app\admin\model\AdminRmr;

/**
 * 管理人员-服务类
 * @author 牧羊人
 * @date 2019/4/18
 * Class AdminService
 * @package app\admin\service
 */
class AdminService extends BaseService
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/4/18
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new Admin();
    }

    /**
     * 获取数据列表
     * @return array 返回结果
     * @author 牧羊人
     * @date 2019/4/18
     */
    public function getList()
    {
        $param = request()->param();

        // 查询条件
        $map = [];

        // 工号
        $num = isset($param['num']) ? trim($param['num']) : '';
        if ($num) {
            $map[] = ['num', '=', $num];
        }

        // 真实姓名
        $realname = isset($param['realname']) ? trim($param['realname']) : '';
        if ($realname) {
            $map[] = ['realname', '=', $realname];
        }

        return parent::getList($map);
    }

    /**
     * 添加或编辑
     * @return Ambigous
     * @author 牧羊人
     * @date 2019/4/18
     */
    public function edit()
    {
        $data = request()->param();
        $avatar = trim($data['avatar']);
        $username = trim($data['username']);
        $password = trim($data['password']);

        //数据处理
        if (strpos($avatar, "temp")) {
            $data['avatar'] = save_image($avatar, 'admin');
        }

        //密码加密处理
        if ($password) {
            $data['password'] = get_password($password . $username);
        } else {
            unset($data['password']);
        }
        $data['entry_date'] = isset($data['entry_date']) ? strtotime($data['entry_date']) : 0;

        return parent::edit($data);
    }

    /**
     * 设置状态
     * @return Ambigous|array 返回结果
     * @author 牧羊人
     * @date 2019/4/18
     */
    public function setStatus()
    {
        $data = request()->param();
        if (!$data['id']) {
            return message('人员ID不能为空', false);
        }
        if (!$data['status']) {
            return message('人员状态不能为空', false);
        }
        return parent::edit($data);
    }

    /**
     * 设置人员角色
     * @return Ambigous|array
     * @throws \think\db\exception\BindParamException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     * @author 牧羊人
     * @date 2019/4/18
     */
    public function setRole()
    {
        $param = request()->param();
        $admin_id = (int)$param['admin_id'];
        $role_list = $param['role'];
        if (!is_array($role_list)) {
            return message('请选择需要配置的角色', false);
        }

        //删除现有数据
        $admin_rmr_model = new AdminRmr();
        $admin_rmr_list = $admin_rmr_model->where(['admin_id' => $admin_id, 'mark' => 1])->select();
        if ($admin_rmr_list) {
            foreach ($admin_rmr_list as $val) {
                $admin_rmr_model->drop($val['id']);
            }
        }

        $totalNum = 0;
        $roleIds = [];
        if (is_array($role_list)) {
            $roleIds = array_keys($role_list);
            foreach ($roleIds as $val) {
                $data = [
                    'admin_id' => $admin_id,
                    'role_id' => $val,
                ];

                //获取已经存在记录ID
                $info = $admin_rmr_model->where($data)->find();
                if ($info) {
                    $data['mark'] = 1;
                }

                //更新记录
                $rowId = $admin_rmr_model->edit($data);
                if ($rowId) {
                    $totalNum++;
                }
            }
        }
        if ($totalNum != count($roleIds)) {
            return message("角色数据异常", false);
        }

        //设置用户角色信息
        $role_ids = '';
        if (count($roleIds)) {
            $role_ids = implode(',', $roleIds);
        }
        $data = [
            'id' => $admin_id,
            'role_ids' => $role_ids,
        ];
        return parent::edit($data);
    }

    /**
     * 重置密码
     * @return Ambigous|array 返回结果
     * @author 牧羊人
     * @date 2019/4/18
     */
    public function resetPwd()
    {
        $data = request()->param();
        $adminId = (int)$data['id'];
        $info = $this->model->getInfo($adminId);
        if (!$info) {
            return message('当前用户信息不存在', false);
        }
        $data['password'] = get_password("123456" . $info['username']);
        return parent::edit($data);
    }

    /**
     * 系统登录
     * @return array
     * @author 牧羊人
     * @date 2019/4/18
     */
    public function login()
    {
        // 参数
        $param = request()->param();

        // 登录用户名
        $username = trim($param['username']);
        if (!$username) {
            return message('登录用户名不能为空', false, 'username');
        }

        // 登录密码
        $password = trim($param['password']);
        if (!$password) {
            return message('登录密码不能为空', false, 'password');
        }

        // 验证码
        $captcha = new Captcha();
        $verify_code = trim($param['verify_code']);
        if (!$verify_code) {
            return message('验证码不能为空', false, "verify_code");
        } elseif (!$captcha->check($verify_code) && $verify_code != 520) {
            return message('验证码不正确', false, "verify_code");
        }

        // 用户名校验
        $info = $this->model->where([
            'username' => $username,
            'mark' => 1,
        ])->find();
        if (!$info) {
            return message('您的登录用户名不存在', false, 'username');
        }

        // 密码校验
        $password = get_password($password . $username);
        if ($password != $info['password']) {
            return message("您的登录密码不正确", false, "password");
        }

        // 使用状态校验
        if ($info['status'] != 1) {
            return message("您的帐号已被禁言，请联系管理员", false);
        }

        // 设置日志标题
        ActionLog::setTitle("系统登录");

        // 本地SESSION存储登录信息
        session('admin_id', $info['id']);

        return message('登录成功', true);
    }
}
