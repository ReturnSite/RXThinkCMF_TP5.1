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

use app\admin\model\Link as LinkModel;
use app\admin\service\LinkService;
use app\admin\validate\Link as LinkValidate;

/**
 * 友链-控制器
 * 
 * @author 牧羊人
 * @date 2019-04-29
 *
 */
class Link extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-04-29
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new LinkModel();
        $this->service = new LinkService();
        $this->validate = new LinkValidate();
    }
    
}