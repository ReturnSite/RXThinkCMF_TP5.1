<?php

namespace app\admin\controller;

use app\admin\model\Ad as AdModel;
use app\admin\service\AdService;
use app\admin\validate\Ad as AdValidate;
use app\admin\model\AdSort;

/**
 * 广告-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-06
 *
 */
class Ad extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-06
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new AdModel();
        $this->service = new AdService();
        $this->validate = new AdValidate();
    }
    
    /**
     * 添加或编辑
     * 
     * @author 牧羊人
     * @date 2019-05-07
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::edit()
     */
    function edit()
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