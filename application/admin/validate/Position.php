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
 *  岗位-验证类
 * @author 牧羊人
 * @date 2019/4/24
 * Class Position
 * @package app\admin\validate
 */
class Position extends BaseValidate
{

    // 验证规则
    protected $rule = [
        'name|岗位名称' => 'require|unique:position|length:1,20',
        'sort|排序' => 'number',
    ];

    // 验证提示语
    protected $message = [
        'name.require' => '岗位名称不能为空',
        'name.unique' => '岗位名称已经存在',
        'name.length' => '岗位名称长度介于1~20个字符',
        'sort.number' => '排序必须是数组',
    ];

    // 验证场景
    protected $scene = [
        'edit' => 'name,sort',
    ];
}
