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

use app\admin\model\Level as LevelModel;
use app\admin\service\LevelService;
use app\admin\validate\Level as LevelValidate;

/**
 * 职级-控制器
 * 
 * @author 牧羊人
 * @date 2019-04-24
 *
 */
class Level extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-04-24
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new LevelModel();
        $this->service = new LevelService();
        $this->validate = new LevelValidate();
    }
    
}