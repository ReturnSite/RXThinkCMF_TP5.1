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

namespace app\install\controller;

use think\Controller;

/**
 * 系统安装-控制器
 *
 * @author 牧羊人
 * @date 2019-04-23
 *
 */
class Index extends Controller
{

    protected $status = [];

    /**
     * 初始化方法
     *
     * @author 牧羊人
     * @date 2019-04-23
     * (non-PHPdoc)
     * @see \think\Controller::initialize()
     */
    public function initialize()
    {
        parent::initialize();

        $this->status = [
            'index' => 'info',
            'check' => 'info',
            'config' => 'info',
            'sql' => 'info',
            'complete' => 'info',
        ];
        if ($this->request->action() != 'complete' &&
            is_file(APP_PATH . 'database.php') &&
            is_file(ROOT_PATH . 'install.lock')) {
            return $this->redirect('/login/index');
        }

        // 产品名称
        $this->assign('product_name', config('install.product_name'));
    }

    /**
     * 安装须知
     *
     * @author 牧羊人
     * @date 2019-04-23
     */
    public function index()
    {
        $this->status['index'] = 'primary';
        $this->assign('status', $this->status);

        $this->assign('company_name', config('install.company_name'));
        $this->assign('company_website_domain', config('install.company_website_domain'));
        $this->assign('website_domain', config('install.website_domain'));
        return $this->fetch();
    }

    /**
     * 检查目录
     *
     * @author 牧羊人
     * @date 2019-04-23
     */
    public function check()
    {
        if ($this->request->isPost()) {
            try {
                if (session('error')) {
                    throw new \Exception("环境检测没有通过，请调整环境后重试！", 0);
                }
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            $this->success('恭喜您环境检测通过', url('config'));
        } else {
            session('error', false);
            //环境检测
            $env = check_env();

            //目录文件读写检测
            if (IS_WRITE) {
                $dirfile = check_dirfile();
                $this->assign('dirfile', $dirfile);
            }

            //函数检测
            $func = check_func();

            session('step', 1);

            $this->assign('env', $env);
            $this->assign('func', $func);

            $this->status['index'] = 'success';
            $this->status['check'] = 'primary';
            $this->assign('status', $this->status);
            return $this->fetch();
        }
    }

    /**
     * 配置数据库
     *
     * @param string $db
     * @param string $admin
     * @param string $webconfig
     * @author 牧羊人
     * @date 2019-04-23
     */
    public function config($db = null, $admin = null, $webconfig = null)
    {
        if ($this->request->isPost()) {
            //检测数据库配置
            $result = $this->validate($db, 'InstallValidate.db_config');
            if (true !== $result) {
                $this->error($result);
            }
            //检测网站配置信息
            $result = $this->validate($webconfig, 'InstallValidate.web_config');
            if (true !== $result) {
                $this->error($result);
            }

            $result = $this->validate($admin, 'InstallValidate.admin_info');
            if (true !== $result) {
                $this->error($result);
            }

            //缓存管理员信息
            $admin_info = [
                'username' => $admin['admin_username'],
                'password' => $admin['admin_password'],
                'repassword' => $admin['admin_repassword'],
                'email' => $admin['admin_email'],
            ];
            session('admin_info', $admin_info);
            //缓存管理员信息
            session('web_config', $webconfig);
            //缓存数据库配置
            session('db_config', $db);

            //创建数据库
            $dbname = $db['database'];
            unset($db['database']);
            $db_instance = \think\Db::connect($db);
            // 检测数据库连接
            try {
                $db_instance->execute('select version()');
            } catch (\Exception $e) {
                $this->error('数据库连接失败，请检查数据库配置！');
            }

            $sql = "CREATE DATABASE IF NOT EXISTS `{$dbname}` DEFAULT CHARACTER SET utf8";
            if (!$db_instance->execute($sql)) {
                return $this->error($db_instance->getError());
            } else {
                $this->redirect('install/index/sql');
            }
        } else {
            $this->status['index'] = 'success';
            $this->status['check'] = 'success';
            $this->status['config'] = 'primary';
            $this->assign('status', $this->status);
            return $this->fetch();
        }
    }

    /**
     * 数据库安装
     *
     * @author 牧羊人
     * @date 2019-04-23
     */
    public function sql()
    {
        session('error', false);
        $this->status['index'] = 'success';
        $this->status['check'] = 'success';
        $this->status['config'] = 'success';
        $this->status['sql'] = 'primary';
        $this->assign('status', $this->status);
        echo $this->fetch();
        if (session('update')) {
            $db_instance = \think\Db::connect();
            //更新数据表
            update_tables($db_instance, config('prefix'));
        } else {
            //连接数据库
            $dbconfig = session('db_config');
            //$dbconfig['params']=['MYSQL_ATTR_USE_BUFFERED_QUERY'=>true];
            $db_instance = \think\Db::connect($dbconfig);
            //创建数据表
            create_tables($db_instance, $dbconfig['prefix']);
            //更新网站信息
            update_webconfig($db_instance, $dbconfig['prefix'], session('web_config'));
            //注册创始人帐号
            register_administrator($db_instance, $dbconfig['prefix'], session('admin_info'));

            //创建配置文件
            $conf = write_config($dbconfig);
            session('config_file', $conf);
        }

        if (session('error')) {
            show_msg('失败');
        } else {
            echo '<script type="text/javascript">location.href = "' . url('install/index/complete') . '";</script>';
        }
    }

    /**
     * 安装完成
     *
     * @author 牧羊人
     * @date 2019-04-23
     */
    public function complete()
    {
        $this->status['index'] = 'success';
        $this->status['check'] = 'success';
        $this->status['config'] = 'success';
        $this->status['sql'] = 'success';
        $this->status['complete'] = 'primary';
        $this->assign('status', $this->status);
        return $this->fetch();
    }
}
