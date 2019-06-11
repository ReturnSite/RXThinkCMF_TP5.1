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

use app\admin\model\AdSort as AdSortModel;
use app\admin\service\AdSortService;
use app\admin\validate\AdSort as AdSortValidate;

/**
 * 广告位-控制器
 * @author 牧羊人
 * @date 2019/5/6
 * Class Adsort
 * @package app\admin\controller
 */
class Adsort extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/6
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AdSortModel();
        $this->service = new AdSortService();
        $this->validate = new AdSortValidate();
    }
}
