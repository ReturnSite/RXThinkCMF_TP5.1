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

use app\common\controller\CommonBase;
use app\admin\model\Admin;

/**
 * 后台基类控制器
 *
 * @author 牧羊人
 * @date 2019-02-25
 */
class AdminBase extends CommonBase
{
    // 模型、服务、校验
    protected $model, $service, $validate;
    // 登录信息
    protected $admin_id, $admin_info;
    // 权限
    protected $system_auth;
    // 请求参数
    protected $param;
    
    /**
     * 初始化操作
     * 
     * @author 牧羊人
     * @date 2019-02-25
     * (non-PHPdoc)
     * @see \app\common\controller\BaseController::initialize()
     */
    function initialize()
    {
        parent::initialize();
        
        // 初始化配置
        $this->initConfig();
        
        // 登录校验
        $this->checkLogin();
        
//         // 权限校验
//         $this->checkAuth();
        
    }
    
    /**
     * 初始化配置
     * 
     * @author 牧羊人
     * @date 2019-02-25
     */
    function initConfig()
    {
        // 请求参数
        $this->param = $this->request->param();
        $this->assign('site_name', config('config')['site_name']);
        $this->assign('nick_name', config('config')['nick_name']);
        
        // 分页基础默认值
        defined('PERPAGE') or define('PERPAGE', isset($this->param['limit']) ? $this->param['limit'] : 20);
        defined('PAGE') or define('PAGE', isset($this->param['page']) ? $this->param['page'] : 1);
    }
    
    /**
     * 检查登录
     * 
     * @author 牧羊人
     * @date 2019-02-25
     */
    function checkLogin()
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
        $this->assign("admin_id" , $this->admin_id);
        $this->assign('admin_info', $this->admin_info);
        $this->system_auth = $this->admin_info['system_auth'];
    }
    
    /**
     * 检查权限
     * 
     * @author 牧羊人
     * @date 2019-02-25
     */
    function checkAuth()
    {
        if (!in_array($this->request->controller(), ['Login','Index'])) {
        
            $reqestUrl = "/".$this->request->controller()."/" . $this->request->action();
            $funcInfo = db('menu')->where([
                'type'      => 4,
                'url'       => $reqestUrl,
                'mark'      => 1
            ])->find();
            if (!$funcInfo) {
                if (IS_POST || IS_GET) {
                    return message('暂无操作权限',false);
                }
                $this->render('Public/404');
                exit;
            }
            $funcArr = $this->system_auth[$funcInfo['parent_id']];
            $funcList = [];
            if (is_array($funcArr)) {
                $keys = array_values($funcArr);
                $map['id'] = array('in',$keys);
                $funcList = db('menu')->where($map)->column('auth');
            }
            if (!in_array($funcInfo['auth'], $funcList)) {
                if (IS_POST) {
                    return message('暂无操作权限',false);
                }
                $this->render('Public/404');
                exit;
            }
            $this->assign('funcList',$funcList);
        
        }
    }
    
    /**
     * 获取导航菜单
     * 
     * @author 牧羊人
     * @date 2019-02-25
     */
    function getNavbar()
    {
        //TODO...
    }
    
    /**
     * 获取面包屑
     * 
     * @author 牧羊人
     * @date 2019-02-25
     */
    function getCrumb()
    {
        //TODO...
    }
    
    /**
     * 空操作捕捉
     *
     * @author 牧羊人
     * @date 2019-02-25
     */
    function _empty()
    {
        return $this->render("public/403");
    }
    
    /**
     * 控制器默认入口
     * 
     * @author 牧羊人
     * @date 2019-02-25
     */
    function index()
    {
        if (IS_POST) {
            $result = $this->service->getList();
            return $result;
        }
        // 默认参数
        $data = func_get_args();
        if ($data) {
            foreach ($data as $key => $val) {
                $this->assign($key, $val);
            }
        }
        return $this->render();
    }
    
    /**
     * 添加或编辑入口
     * 
     * @author 牧羊人
     * @date 2019-02-25
     */
    function edit()
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
            if ($data) {
                foreach ($data as $key => $val) {
                    $info[$key] = $val;
                }
            }
        }
        $this->assign('info', $info);
        return $this->render();
    }
    
    /**
     * 详情入口
     * 
     * @author 牧羊人
     * @date 2019-02-25
     */
    function detail()
    {
        if (IS_POST) {
            $result = $this->service->edit();
            return $result;
        }
        $id = input("get.id", 0);
        if ($id) {
            $info = $this->model->getInfo($id);
            $this->assign('info',$info);
        }
        return $this->render();
    }
    
    /**
     * 删除单条记录
     * 
     * @author 牧羊人
     * @date 2019-02-25
     */
    function drop()
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
     * 
     * @author 牧羊人
     * @date 2019-05-09
     */
    function cache()
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
     * 
     * @author 牧羊人
     * @date 2019-05-09
     */
    function copy()
    {
        if (IS_POST) {
            $result = $this->service->edit();
            return $result;
        }
        $info = [];
        $id = input("get.id",0);
        if ($id) {
            $info = $this->model->getInfo($id);
        } else {
            $data = func_get_args();
            if ($data) {
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
     * 
     * @author 牧羊人
     * @date 2019-05-12
     */
    function update()
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
     * 
     * @author 牧羊人
     * @date 2019-02-25
     */
    function batchDrop()
    {
        if (IS_POST) {
            $ids = explode(',', $_POST['id']);
            //批量删除
            $num = 0;
            foreach ($ids as $key => $val) {
                $res = $this->model->drop($val);
                if ($res!==false) $num++;
            }
            return message('本次共选择' . count($ids) . "个条数据,删除" . $num . "个");
        }
    }
    
    /**
     * 批量重置缓存
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * @return Ambigous <number, multitype:string unknown >
     */
    function batchCache()
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
     * 
     * @author 牧羊人
     * @date 2019-05-15
     */
    function batchStatus()
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
                if ($result) $num++;
            }
            return message("本次共更新【{$num}】条记录");
        }
    }
    
    /**
     * 模板渲染
     * 
     * @author 牧羊人
     * @date 2019-02-25
     */
    function render($tpl = "", $data = [])
    {
        return $this->fetch($tpl, $data);
    }
    
}