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

use app\admin\model\Dictype as DictypeModel;
use app\admin\service\DictypeService;
use app\admin\validate\Dictype as DictypeValidate;

/**
 * 字典类型-控制器
 * @author 牧羊人
 * @date 2019/5/9
 * Class Dictype
 * @package app\admin\controller
 */
class Dictype extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/9
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new DictypeModel();
        $this->service = new DictypeService();
        $this->validate = new DictypeValidate();
    }
}
