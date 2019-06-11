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

use app\admin\model\Ad as AdModel;
use app\admin\service\AdService;
use app\admin\validate\Ad as AdValidate;
use app\admin\model\AdSort;

/**
 * 广告-控制器
 * @author 牧羊人
 * @date 2019/5/6
 * Class Ad
 * @package app\admin\controller
 */
class Ad extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/6
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AdModel();
        $this->service = new AdService();
        $this->validate = new AdValidate();
    }
    
    /**
     * 添加或编辑
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/5/6
     */
    public function edit()
    {
        // 获取广告位
        $ad_sort_model = new AdSort();
        $sort_list = $ad_sort_model->where(['mark' => 1])->select();
        $this->assign('sort_list', $sort_list ? $sort_list->toArray() : []);

        return parent::edit([
            'type' => 1,
        ]);
    }
}
