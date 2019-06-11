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

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 管理员角色-模型
 * @author 牧羊人
 * @date 2019/4/21
 * Class AdminRole
 * @package app\admin\model
 */
class AdminRole extends BaseModel
{
    // 设置数据表
    protected $table = 'think_admin_role';

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/4/21
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }

    /**
     * 获取缓存信息
     * @param int $id 记录ID
     * @return mixed 返回结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/4/21
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id);
        if ($info) {
            // 权限反序列化
            if ($info['auth']) {
                $info['auth_list'] = unserialize($info['auth']);
            }

        }
        return $info;
    }

    /**
     * 获取角色权限
     * @param $role_ids 角色ID
     * @return array 返回结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/4/21
     */
    public function getRoleAuth($role_ids)
    {
        if (!is_array($role_ids)) {
            return [];
        }
        $list = [];
        foreach ($role_ids as $val) {
            $info = $this->getInfo($val);
            if (!$info) {
                continue;
            }

            $auth = isset($info['auth_list']) ? $info['auth_list'] : '';
            if (!is_array($auth)) {
                continue;
            }

            foreach ($auth as $kt => $vt) {
                if (!in_array($kt, array_keys($list))) {
                    $list[$kt] = [];
                }
                foreach ($vt as $v) {
                    if (!in_array($v, $list[$kt])) {
                        $list[$kt][] = $v;
                    }
                }
            }
        }
        return $list;
    }
}
