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

namespace app\admin\validate;

use app\common\validate\BaseValidate;

/**
 * 友链-验证类
 * 
 * @author 牧羊人
 * @date 2019-04-29
 *
 */
class Link extends BaseValidate
{
    // 验证规则
    protected $rule = [
        'name|友链名称' => 'require|length:1,20',
        'sort|排序'    => 'number',
    ];
    
    // 验证提示语
    protected $message = [
        'name.require' => '友链名称不能为空',
        'name.length'  => '友链名称长度介于1~20个字符',
        'sort.number'  => '排序必须是数组',
    ];
    
    // 验证场景
    protected $scene = [
        'edit' => 'name,sort',
    ];
}