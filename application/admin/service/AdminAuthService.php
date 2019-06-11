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

use app\admin\model\Menu as MenuModel;
use app\admin\model\AdminRole as AdminRoleModel;
use app\admin\model\Admin as AdminModel;
use app\admin\model\AdminRom as AdminRomModel;

/**
 * 权限设置-服务类
 * @author 牧羊人
 * @date 2019/5/15
 * Class AdminAuthService
 * @package app\admin\service
 */
class AdminAuthService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/15
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new MenuModel();
    }

    /**
     * 获取数据列表
     * @return array 返回结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/5/15
     */
    public function getList()
    {
        $param = request()->param();
        $type = (int)$param['type'];
        $type_id = (int)$param['type_id'];
        $list = $this->model->getChilds(0, false);
        if ($list) {
            foreach ($list as &$val) {
                foreach ($val['children'] as &$vt) {
                    foreach ($vt['children'] as &$vo) {
                        $id = $vo['id'];

                        if ($type == 1) {
                            //角色

                            $admin_role_model = new AdminRoleModel();
                            $role_info = $admin_role_model->getInfo($type_id);
                            $role_list = $role_info['auth_list'];
                            $func_list = isset($role_list[$id]) ? $role_list[$id] : [];

                        } elseif ($type == 2) {
                            //人员

                            $admin_model = new AdminModel();
                            $role_info = $admin_model->getInfo($type_id);
                            $role_list = $role_info['auth_list'];
                            $func_list = $role_list[$id];

                        }

                        $func_arr = isset($vo['funcList']) ? $vo['funcList'] : '';
                        if (is_array($func_arr)) {
                            foreach ($vo['funcList'] as &$v) {
                                if (in_array($v["id"], $func_list)) {
                                    $v['selected'] = 1;
                                }
                            }
                        }
                    }
                }
            }
        }
        return message("操作成功", true, $list);
    }

    /**
     * 设置权限
     * @return array 返回结果
     * @throws \think\db\exception\BindParamException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     * @author 牧羊人
     * @date 2019/5/15
     */
    public function setAuth()
    {
        $param = request()->param();
        $type = (int)$param['type'];
        $type_id = (int)$param['type_id'];
        $auth = $param["auth"];
        if (!$type) {
            return message('类型不能为空', false);
        }
        if (!$type_id) {
            return message('类型ID不能为空', false);
        }

        //获取节点权限
        $list = [];
        if (is_array($auth)) {
            $result = array_keys($auth);
            if (is_array($result)) {
                foreach ($result as $val) {
                    $item_arr = explode(',', $val);
                    $list[$item_arr[0]][] = $item_arr[1];
                }
            }
        }

        //删除现有数据
        $admin_rom_model = new AdminRomModel();
        $admin_rom_list = $admin_rom_model->where(['type' => $type, 'type_id' => $type_id])->select();
        if ($admin_rom_list) {
            foreach ($admin_rom_list as $val) {
                $admin_rom_model->drop($val['id']);
            }
        }

        //遍历最新的数据源
        $num = 0;
        $auth_str = null;
        if (is_array($list)) {
            //序列化数组
            $auth_str = serialize($list);

            //数据处理
            foreach ($list as $menu_id => $val) {
                if (!$menu_id) {
                    continue;
                }

                //重复性验证
                $info = $admin_rom_model->where([
                    'type' => $type,
                    'type_id' => $type_id,
                    'menu_id' => $menu_id
                ])->find();

                $func = "";
                if (is_array($val)) {
                    $func = implode(',', $val);
                }

                $data = [
                    'id' => $info['id'],
                    'type' => $type,
                    'type_id' => $type_id,
                    'menu_id' => $menu_id,
                    'func_node' => $func,
                    'mark' => 1,
                ];
                $row_id = $admin_rom_model->edit($data);
                if ($row_id) {
                    $num++;
                }
            }
        }

        if ($type == 1) {
            //角色权限配置
            $auth_model = new AdminRoleModel();
        } elseif ($type == 2) {
            //人员权限配置
            $auth_model = new AdminModel();
        }
        $item = [
            'id' => $type_id,
            'auth' => $auth_str,
        ];
        $error = '';
        $row_id = $auth_model->edit($item, $error);
        if ($row_id) {
            return message();
        }
        return message($error, false);
    }
}
