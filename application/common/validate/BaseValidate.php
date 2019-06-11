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

namespace app\common\validate;

use think\Validate;

/**
 * 基类验证器
 * @author 牧羊人
 * @date 2019/4/22
 * Class BaseValidate
 * @package app\common\validate
 */
class BaseValidate extends Validate
{
    // 验证规则
    protected $rule = [

    ];

    // 验证提示语
    protected $message = [

    ];

    // 验证场景
    protected $scene = [

    ];
}
