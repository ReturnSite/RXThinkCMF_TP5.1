<?php

namespace app\admin\service;

use app\admin\model\Ad as AdModel;

/**
 * 广告-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-06
 *
 */
class AdService extends BaseService
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-06
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new AdModel();
    }
    
    /**
     * 添加或编辑
     * 
     * @author 牧羊人
     * @date 2019-05-07
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::edit()
     */
    function edit()
    {
        $data = request()->param();
        
        // 图片处理
        $cover = trim($data['cover']);
        if (strpos($cover, "temp")) {
            $data['cover'] = save_image($cover, 'ad');
        }
        
        return parent::edit($data);
    }
    
}