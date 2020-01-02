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

use app\common\controller\BaseController;
use app\admin\model\Admin;

/**
 * 后台基类控制器
 * @author 牧羊人
 * @date 2019/2/25
 * Class AdminBase
 * @package app\admin\controller
 */
class AdminBase extends BaseController
{
    // 模型
    protected $model;
    // 服务
    protected $service;
    // 校验
    protected $validate;
    // 登录ID
    protected $admin_id;
    // 登录信息
    protected $admin_info;
    // 权限
    protected $system_auth;
    // 请求参数
    protected $param;

    /**
     * 初始化操作
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function initialize()
    {
        parent::initialize();

        // 初始化配置
        $this->initConfig();

        // 登录校验
        $this->checkLogin();

        // 权限校验
        $this->checkAuth();
    }

    /**
     * 初始化配置
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function initConfig()
    {
        // 获取系统配置信息
        $this->assign('site_name', SITE_NAME);
        $this->assign('nick_name', NICK_NAME);

        // 请求参数
        $this->param = $this->request->param();

        // 分页基础默认值
        defined('PERPAGE') or define('PERPAGE', isset($this->param['limit']) ? $this->param['limit'] : 20);
        defined('PAGE') or define('PAGE', isset($this->param['page']) ? $this->param['page'] : 1);
    }

    /**
     * 检查登录
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function checkLogin()
    {
        $noLoginActs = ['Login'];
        if (session('admin_id') == null && !in_array($this->request->controller(), $noLoginActs)) {
            $this->redirect('/login/index');
            exit;
        }

        // 登录用户ID
        $admin_id = session('admin_id');
        $this->admin_id = $admin_id;

        // 登录用户信息
        $admin_model = new Admin();
        $admin_info = $admin_model->getInfo($admin_id);
        $this->admin_info = $admin_info;

        // 数据渲染
        $this->assign("admin_id", $this->admin_id);
        $this->assign('admin_info', $this->admin_info);
        $this->system_auth = $this->admin_info['system_auth'];
    }

    /**
     * 检查权限
     * @return array 返回结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function checkAuth()
    {
        if (!in_array($this->request->controller(), ['Login', 'Index'])) {
            // 获取菜单模块信息
            $menuMod = new \app\admin\model\Menu();
            $info = $menuMod->getInfoByAttr([
                ['type', '=', 3],
                ['url', '=', strtolower($this->request->controller())],
            ]);
            if (!$info) {
                if (IS_POST) {
                    return message('暂无操作权限', false);
                }
                $this->assign('funcList', []);
                return $this->render('public/404');
            }

            // 获取操作权限点信息
            $requestUrl = strtolower("/" . $this->request->controller() . "/" . $this->request->action());
            $funcInfo = $menuMod->where([
                'parent_id' => $info['id'],
                'type' => 4,
                'url' => $requestUrl,
                'mark' => 1
            ])->find();
            if (!$funcInfo) {
                if (IS_POST || IS_GET) {
                    return message('暂无操作权限', false);
                }
                return $this->render('public/404');
            }

            // 获取操作权限节点列表
            $funcArr = isset($this->system_auth[$info['id']]) ? $this->system_auth[$info['id']] : [];
            $funcList = [];
            if (is_array($funcArr)) {
                $keys = array_values($funcArr);
                $funcList = $menuMod->where([
                    ['id', 'in', $keys]
                ])->column('auth');
            }
            $this->assign('funcList', $funcList);
            if (!in_array($funcInfo['auth'], $funcList)) {
                if (IS_POST) {
                    return message('暂无操作权限', false);
                }
                return $this->render('public/404');
            }
        }
    }

    /**
     * 获取导航菜单
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function getNavbar()
    {
        //TODO...
    }

    /**
     * 获取面包屑
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function getCrumb()
    {
        //TODO...
    }

    /**
     * 空操作捕捉
     * @return mixed
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function _empty()
    {
        return $this->render("public/403");
    }

    /**
     * 控制器默认入口
     * @return mixed
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function index()
    {
        if (IS_POST) {
            $result = $this->service->getList();
            return $result;
        }
        // 默认参数
        $data = func_get_args();
        if (isset($data[0])) {
            foreach ($data[0] as $key => $val) {
                $this->assign($key, $val);
            }
        }
        return $this->render();
    }

    /**
     * 添加或编辑入口
     * @return mixed
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function edit()
    {
        if (IS_POST) {
            $result = $this->service->edit();
            return $result;
        }
        $info = [];
        $id = input("get.id", 0);
        if ($id) {
            $info = $this->model->getInfo($id);
        } else {
            $data = func_get_args();
            if (isset($data[0])) {
                foreach ($data[0] as $key => $val) {
                    $info[$key] = $val;
                }
            }
        }
        $this->assign('info', $info);
        return $this->render();
    }

    /**
     * 详情入口
     * @return mixed
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function detail()
    {
        if (IS_POST) {
            $result = $this->service->edit();
            return $result;
        }
        $id = input("get.id", 0);
        if ($id) {
            $info = $this->model->getInfo($id);
            $this->assign('info', $info);
        }
        return $this->render();
    }

    /**
     * 模板渲染
     * @param string $tpl 模板地址
     * @param array $data 参数
     * @return mixed
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function render($tpl = "", $data = [])
    {
        return $this->fetch($tpl, $data);
    }

    /**
     * 删除单条记录
     * @return array
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function drop()
    {
        if (IS_POST) {
            $id = input('post.id');
            $info = $this->model->getInfo($id);
            if ($info) {
                $result = $this->model->drop($id);
                if ($result !== false) {
                    return message();
                }
            }
            return message($this->model->getError(), false);
        }
    }

    /**
     * 重置缓存
     * @return array
     * @author 牧羊人
     * @date 2019/5/12
     */
    public function cache()
    {
        if (IS_POST) {
            $id = input('post.id');
            if (!$id) {
                return message("记录ID不能为空", false);
            }
            $result = $this->model->_cacheReset($id, '');
            if (!$result) {
                return message("缓存重置失败", false);
            }
            return message("缓存重置成功");
        }
    }

    /**
     * 一键复制
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/12
     */
    public function copy()
    {
        if (IS_POST) {
            $result = $this->service->edit();
            return $result;
        }
        $info = [];
        $id = input("get.id", 0);
        if ($id) {
            $info = $this->model->getInfo($id);
        } else {
            $data = func_get_args();
            if (isset($data[0])) {
                foreach ($data[0] as $key => $val) {
                    $info[$key] = $val;
                }
            }
        }
        // 复制作为新增数据，主键ID必须置空
        unset($info['id']);
        $this->assign('info', $info);
        return $this->render('edit');
    }

    /**
     * 更新单个字段
     * @return array
     * @author 牧羊人
     * @date 2019/5/12
     */
    public function update()
    {
        if (IS_POST) {
            $data = request()->param();
            $result = $this->model->edit($data);
            if ($result) {
                return message("更新成功");
            } else {
                return message("更新失败", false);
            }
        }
    }

    /**
     * 批量删除记录
     * @return array
     * @author 牧羊人
     * @date 2019/2/25
     */
    public function batchDrop()
    {
        if (IS_POST) {
            $ids = explode(',', $_POST['id']);
            //批量删除
            $num = 0;
            foreach ($ids as $key => $val) {
                $res = $this->model->drop($val);
                if ($res !== false) {
                    $num++;
                }
            }
            return message('本次共选择' . count($ids) . "个条数据,删除" . $num . "个");
        }
    }

    /**
     * 批量重置缓存
     * @return array
     * @author 牧羊人
     * @date 2019/5/9
     */
    public function batchCache()
    {
        if (IS_POST) {
            $ids = explode(',', $_POST['id']);
            //重置缓存
            foreach ($ids as $key => $val) {
                $this->model->_cacheReset($val);
            }
            return message('重置缓存成功！');
        }
    }

    /**
     * 批量设置状态
     * @return array
     * @author 牧羊人
     * @date 2019/5/15
     */
    public function batchStatus()
    {
        if (IS_POST) {
            $ids = explode(',', $_POST['id']);
            $status = (int)$_POST['status'];
            if (!is_array($ids)) {
                return message("请选择数据记录", false);
            }
            $num = 0;
            foreach ($ids as $key => $val) {
                $result = $this->model->edit([
                    'id' => $val,
                    'status' => $status,
                ]);
                if ($result) {
                    $num++;
                }
            }
            return message("本次共更新【{$num}】条记录");
        }
    }

    /**
     * 设置状态
     * @return mixed
     * @author 牧羊人
     * @date 2019/11/2
     */
    public function setStatus()
    {
        if (IS_POST) {
            $result = $this->service->setStatus();
            return $result;
        }
    }
}
