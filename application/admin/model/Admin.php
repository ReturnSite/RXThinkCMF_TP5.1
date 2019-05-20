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

namespace app\admin\model;

use app\common\model\BaseModel;
use app\admin\model\AdminRole as AdminRoleModel;

/**
 * 人员管理-模型
 *
 * @author 牧羊人
 * @date 2019-03-20
 */
class Admin extends BaseModel
{
    // 设置数据表
    protected $table = 'think_admin';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-03-20
     * (non-PHPdoc)
     * @see \app\common\model\CBaseModel::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * 获取缓存信息
     * 
     * @author 牧羊人
     * @date 2019-03-20
     * (non-PHPdoc)
     * @see \app\common\model\CBaseModel::getInfo()
     */
    function getInfo($id)
    {
        $info = parent::getInfo($id);
        if ($info) {

            // 头像
            if ($info['avatar']) {
                $info['avatar_url'] = get_image_url($info['avatar']);
            }
            
            // 入职日期
            if ($info['entry_date']) {
                $info['format_entry_date'] = datetime($info['entry_date'], 'Y-m-d');
            }
            
            // 性别
            if ($info['gender']) {
                $info['gender_name'] = config('config.gender_list')[$info['gender']];
            }
            
            // 岗位
            if ($info['position_id']) {
                $position_model = new Position();
                $position_info = $position_model->getInfo($info['position_id']);
                $info['position_name'] = $position_info['name'];
            }
            
            // 独立权限
            $auth_list = [];
            if ($info['auth']) {
                $admin_auth = unserialize($info['auth']);
                if (is_array($admin_auth)) {
                    foreach ($admin_auth as $key => $val) {
                        $auth_list[$key][] = $val;
                    }
                }
            }
            
            // 角色权限
            if ($info['role_ids']) {
                $role_ids = explode(',', $info['role_ids']);
                $admin_role_model = new AdminRoleModel();
                $role_auth = $admin_role_model->get_role_auth($role_ids);
                if (is_array($role_auth)) {
                    foreach ($role_auth as $kt => $vt) {
                        $auth_list[$kt][] = $vt;
                    }
                }
            }
            
            // 权限重组
            $auth = [];
            foreach ($auth_list as $key => $val) {
                if (!in_array($key, array_keys($auth))) {
                    $auth[$key] = array();
                }
                foreach ($val as $vt) {
                    foreach ($vt as $v) {
                        if (!in_array($v, $auth[$key])) {
                            $auth[$key][] = $v;
                        }
                    }
                }
            }
            $info['system_auth'] = $auth;
            
        }
        return $info;
    }
    
}