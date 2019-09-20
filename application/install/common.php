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

use util\Accredit;

// 检测环境是否支持可写
define('IS_WRITE', true);

/**
 * 系统环境监测
 *
 * @author 牧羊人
 * @date 2019-04-23
 */
function check_env()
{
    $items = [
        'os' => ['操作系统', '不限制', '类Unix', PHP_OS, 'bg-green'],
        'php' => ['PHP版本', '5.6.33', '5.6+', PHP_VERSION, 'bg-green'],
        'upload' => ['附件上传', '不限制', '2M+', '未知', 'bg-green'],
        'gd' => ['GD库', '2.0', '2.0+', '未知', 'bg-green'],
        'fileinfo' => ['fileinfo扩展', '1.0.5', '1.0+', '未知', 'bg-green'],
        'disk' => ['磁盘空间', '50M', '不限制', '未知', 'bg-green'],
    ];

    //PHP环境检测
    if ($items['php'][3] < $items['php'][1]) {
        $items['php'][4] = 'bg-yellow';
        session('error', true);
    }

    //附件上传检测
    if (@ini_get('file_uploads'))
        $items['upload'][3] = ini_get('upload_max_filesize');

    //GD库检测
    $tmp = function_exists('gd_info') ? gd_info() : array();
    if (empty($tmp['GD Version'])) {
        $items['gd'][3] = '未安装';
        $items['gd'][4] = 'bg-yellow';
        session('error', true);
    } else {
        $items['gd'][3] = $tmp['GD Version'];
    }
    unset($tmp);

    //fileinfo扩展检测
    if (!extension_loaded('fileinfo')) {
        $items['fileinfo'][3] = '未安装';
        $items['fileinfo'][4] = 'bg-yellow';
        session('error', true);
    } else {
        $items['fileinfo'][3] = '已开启';
    }

    //磁盘空间检测
    if (function_exists('disk_free_space')) {
        $items['disk'][3] = floor(disk_free_space(ROOT_PATH) / (1024 * 1024)) . 'M';
    }

    return $items;
}

/**
 * 目录文件读写检测
 *
 * @author 牧羊人
 * @date 2019-04-23
 */
function check_dirfile()
{
    $items = [
        ['dir', '可写', 'bg-green', 'public/uploads/img/'],
        ['dir', '可写', 'bg-green', 'public/uploads/img/temp/'],
        ['dir', '可写', 'bg-green', 'public/static/plugins/'],
        ['dir', '可写', 'bg-green', 'data/backup/'],
    ];

    foreach ($items as &$val) {
        $item = ROOT_PATH . $val[3];
        if ('dir' == $val[0]) {
            if (!is_dir($item)) {
                // 创建文件夹并赋予权限
                mkdir($item, 0777, true);
            }
            if (!is_writable($item)) {
                if (is_dir($item)) {
                    $val[1] = '可读';
                    $val[2] = 'bg-yellow';
                    session('error', true);
                } else {
                    $val[1] = '不存在';
                    $val[2] = 'bg-yellow';
                    session('error', true);
                }
            }
        } else {
            if (file_exists($item)) {
                if (!is_writable($item)) {
                    $val[1] = '不可写';
                    $val[2] = 'bg-yellow';
                    session('error', true);
                }
            } else {
                if (!is_writable(dirname($item))) {
                    $val[1] = '不存在';
                    $val[2] = 'bg-yellow';
                    session('error', true);
                }
            }
        }
    }

    return $items;
}

/**
 * 函数检测
 *
 * @return multitype:multitype:string
 * @author 牧羊人
 * @date 2019-04-23
 */
function check_func()
{
    $items = array(
        array('pdo', '支持', 'bg-green', '类'),
        array('pdo_mysql', '支持', 'bg-green', '模块'),
        array('file_get_contents', '支持', 'bg-green', '函数'),
        array('mb_strlen', '支持', 'bg-green', '函数'),
    );

    foreach ($items as &$val) {
        if (('类' == $val[3] && !class_exists($val[0]))
            || ('模块' == $val[3] && !extension_loaded($val[0]))
            || ('函数' == $val[3] && !function_exists($val[0]))
        ) {
            $val[1] = '不支持';
            $val[2] = 'bg-yellow';
            session('error', true);
        }
    }

    return $items;
}

/**
 * 写入文件配置
 *
 * @author 牧羊人
 * @date 2019-04-23
 */
function write_config($config, $web_config)
{
    if (is_array($config)) {

        // 系统名称
        $web_site_title = $web_config['web_site_title'];
        // 后台访问地址
        $index_url = $web_config['index_url'];
        $itemArr = explode('://', $index_url);
        if (is_array($itemArr)) {
            $result = explode('.', $itemArr[1]);
            $domain = $result[1] . "." . $result[2];

            // 设置域名及系统名称配置
            $config['domain'] = $domain;
            $config['site_name'] = $web_site_title;
            $config['attachment_path'] = ROOT_PATH;
        }
        //读取配置内容
        $conf = file_get_contents(APP_PATH . 'install/data/config.inc.tpl');
        //替换配置项
        foreach ($config as $name => $value) {
            $conf = str_replace("[{$name}]", $value, $conf);
        }
        //安装信息
        Accredit::runAccredit();
        //file_put_contents(APP_PATH . 'install.lock', 'ok');

        //写入应用配置文件
        if (file_put_contents(ROOT_PATH . 'config/config.inc.php', $conf)) {
            show_msg('配置文件写入成功');
        } else {
            show_msg('配置文件写入失败！', 'error');
            session('error', true);
        }
        return '';
    }
}

/**
 * 创建数据表
 *
 * @author 牧羊人
 * @date 2019-04-23
 */
function create_tables($db, $prefix = '')
{
    try {
        //读取SQL文件
        $sql_file = APP_PATH . 'install/data/install.sql';
        if (!is_file($sql_file)) {
            throw new \Exception("install.sql文件损坏或目录文件权限不足", 0);
        }
        $sql = file_get_contents($sql_file);
        $sql = str_replace("\r", "\n", $sql);
        $sql = explode(";\n", $sql);

        //替换表前缀
        $orginal = 'think_';

        //开始安装
        show_msg('开始安装数据库...');
        foreach ($sql as $sub_sql) {
            //替换前缀
            $sub_sql = str_replace(" `{$orginal}", " `{$prefix}", $sub_sql);
            $sub_sql = trim($sub_sql);
            if (empty($sub_sql)) continue;
            if (strpos($sub_sql, 'CREATE TABLE') !== false) {
                //$name = preg_replace("/^CREATE TABLE `(\w+)` .*/s", "\\1", $sub_sql);
                preg_match("/CREATE TABLE `(\w+)` .*/i", $sub_sql, $result);
                $msg = "创建数据表{$result[1]}";
                if (false !== $db->execute($sub_sql)) {
                    show_msg($msg . '...成功');
                } else {
                    show_msg($msg . '...失败！', 'error');
                    session('error', true);
                }
            } else {
                $db->execute($sub_sql);
            }

        }
    } catch (\Exception $e) {
        show_msg($e, 'error');
    }
}

/**
 * 创建系统管理员
 *
 * @author 牧羊人
 * @date 2019-04-23
 */
function register_administrator($db, $prefix, $admin)
{
    show_msg('开始注册创始人帐号...');

    $password = get_password($admin['password'] . $admin['username']);

    $sql = "INSERT INTO `[PREFIX]admin` (`id`,`organization_id`,`dept_id`,`realname`,`num`, `username`,`password`,`auth`,`role_ids`,`position_id`,`avatar`,`status`,`mobile`,`email`,`identity`,`entry_date`,`province_id`,`city_id`,`district_id`,`is_admin`,`note`,`sort`,`login_num`,`login_ip`,`login_time`,`create_time`,`mark`) VALUES (1, 1, 0, '超级管理员', 'D0001', '[NAME]', '[PASS]', 'a:0:{}', '1', 0, '/admin/20190826//0aab809cad0482cc559.jpg', 1, '15295504264', '[EMAIL]', '320821198902452789', 1557331200, 1387, 1388, 1391, 1,'暂无', 125, 3185, '[IP]', 1555933830, '[TIME]', 1);";
    $sql = str_replace(
        ['[PREFIX]', '[NAME]', '[PASS]', '[EMAIL]', '[TIME]', '[IP]'],
        [$prefix, $admin['username'], $password, $admin['email'], time(), get_client_ip(1)],
        $sql);
    $db->execute($sql);
    show_msg('创始人帐号注册完成！');
}

/**
 * 更新网站信息
 *
 * @author 牧羊人
 * @date 2019-04-23
 */
function update_webconfig($db, $prefix, $webconfig)
{
    show_msg('开始更新网站配置...');

    $sql = "UPDATE `{$prefix}config`
    SET value = CASE name
    WHEN 'web_site_title' THEN '{$webconfig['web_site_title']}'
		        WHEN 'index_url' THEN '{$webconfig['index_url']}'
    		        WHEN 'web_site_description' THEN '{$webconfig['web_site_description']}'
		        WHEN 'web_site_keyword' THEN '{$webconfig['web_site_keyword']}'
		    END
    		            WHERE name IN ('web_site_title','index_url','web_site_description','web_site_keyword')";
    $db->execute($sql);
    show_msg('更新网站配置完成！');
}

/**
 * 更新数据表
 *
 * @author 牧羊人
 * @date 2019-04-23
 */
function update_tables($db, $prefix = '')
{
    //读取SQL文件
    $sql = file_get_contents(ROOT_PATH . 'data/update.sql');
    $sql = str_replace("\r", "\n", $sql);
    $sql = explode(";\n", $sql);

    //替换表前缀
    $sql = str_replace(" `think_", " `{$prefix}", $sql);

    //开始安装
    show_msg('开始升级数据库...');
    foreach ($sql as $value) {
        $value = trim($value);
        if (empty($value)) continue;
        if (substr($value, 0, 12) == 'CREATE TABLE') {
            $name = preg_replace("/^CREATE TABLE `(\w+)` .*/s", "\\1", $value);
            $msg = "创建数据表{$name}";
            if (false !== $db->execute($value)) {
                show_msg($msg . '...成功');
            } else {
                show_msg($msg . '...失败！', 'error');
                session('error', true);
            }
        } else {
            if (substr($value, 0, 8) == 'UPDATE `') {
                $name = preg_replace("/^UPDATE `(\w+)` .*/s", "\\1", $value);
                $msg = "更新数据表{$name}";
            } else if (substr($value, 0, 11) == 'ALTER TABLE') {
                $name = preg_replace("/^ALTER TABLE `(\w+)` .*/s", "\\1", $value);
                $msg = "修改数据表{$name}";
            } else if (substr($value, 0, 11) == 'INSERT INTO') {
                $name = preg_replace("/^INSERT INTO `(\w+)` .*/s", "\\1", $value);
                $msg = "写入数据表{$name}";
            }
            if (($db->execute($value)) !== false) {
                show_msg($msg . '...成功');
            } else {
                show_msg($msg . '...失败！', 'error');
                session('error', true);
            }
        }
    }
}

/**
 * 显示提示信息
 *
 * @author 牧羊人
 * @date 2019-04-23
 */
function show_msg($msg, $class = 'success')
{
    echo "<script type=\"text/javascript\">showmsg(\"{$msg}\", \"{$class}\")</script>";
    ob_flush();
    flush();
}

/**
 * 生成系统AUTH_KEY
 *
 * @return string 输出字符串
 * @author 牧羊人
 * @date 2019-04-23
 */
function build_auth_key()
{
    $chars = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $chars .= '`~!@#$%^&*()_+-=[]{};:"|,.<>/?';
    $chars = str_shuffle($chars);
    return substr($chars, 0, 40);
}

