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

/**
 * 管理员角色-模型
 * 
 * @author 牧羊人
 * @date 2019-04-21
 *
 */
class AdminRole extends BaseModel
{
    // 设置数据表
    protected $table = 'think_admin_role';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-04-21
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::initialize()
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
     * @date 2019-04-21
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::getInfo()
     */
    function getInfo($id) 
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
     * 
     * @author 牧羊人
     * @date 2019-04-21
     */
    function get_role_auth($role_ids) 
    {
        if(!is_array($role_ids)) {
            return [];
        }
        $list = [];
        foreach ($role_ids as $val) {
            $info = $this->getInfo($val);
            if (!$info) continue;
            
            $auth = isset($info['auth_list']) ? $info['auth_list'] : '';
            if(!is_array($auth)) continue;
            
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