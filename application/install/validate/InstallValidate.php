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

namespace app\install\validate;

use think\Validate;

/**
 * 安装验证类
 *
 * @author 牧羊人
 * @date 2019-04-23
 * @author home
 *
 */
class InstallValidate extends Validate
{
    // 验证规则
    protected $rule = [
        //管理员信息验证规则
        'admin_username' => 'require|length:1,32|regex:^(?!_)(?!\d)(?!.*?_$)[\w]+$',
        'admin_password' => 'require|length:6,30',
        'admin_repassword' => 'require|confirm:admin_password',
        'admin_email' => 'require|email',
        //网站信息验证规则
        'web_site_title' => 'require',
        'index_url' => 'require',
        'web_site_description' => 'require',
        'web_site_keyword' => 'require',
        //数据库验证规则
        'type' => 'require',
        'hostname' => 'require',
        'database' => 'require',
        'username' => 'require',
        'password' => 'require',
        'hostport' => 'require|number|gt:0',
        'prefix' => 'require',
    ];

    // 验证提示语
    protected $message = [
        'admin_username.require' => '请填写用户名',
        'admin_username.length' => '用户名长度为1-32个字符',
        'admin_username.regex' => '用户名只可含有数字、字母、下划线且不以下划线开头结尾，不以数字开头！',
        'admin_password.require' => '请填写密码',
        'admin_password.length' => '密码长度为6-30位',
        'admin_repassword.require' => '请填写重复密码',
        'admin_repassword.confirm' => '两次输入的密码不一致',
        'admin_email.require' => '请填写邮箱',
        'admin_email.email' => '邮箱格式不正确',

        'web_site_title.require' => '请填写完整网站信息',
        'index_url.require' => '请填写完整网站信息',
        'web_site_description.require' => '请填写完整网站信息',
        'web_site_keyword.require' => '请填写完整网站信息',

        'type.require' => '请填写完整的数据库配置1',
        'hostname.require' => '请填写完整的数据库配置2',
        'database.require' => '请填写完整的数据库配置3',
        'username.require' => '请填写完整的数据库配置4',
        'password.require' => '请填写完整的数据库配置5',
        'hostport.require' => '请填写完整的数据库配置6',
        'prefix.require' => '请填写完整的数据库配置7',

    ];

    // 验证场景
    protected $scene = [
        'admin_info' => ['admin_username', 'admin_password', 'admin_repassword', 'admin_email'],
        'web_config' => ['web_site_title', 'index_url', 'web_site_description', 'web_site_keyword'],
        'db_config' => ['type', 'hostname', 'database', 'username', 'hostport', 'prefix'],
    ];
}
