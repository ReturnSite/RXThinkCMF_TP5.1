<?php

namespace app\admin\service;

use app\admin\model\Layout as LayoutModel;

/**
 * 布局-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-06
 *
 */
class LayoutService extends BaseService
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
        $this->model = new LayoutModel();
    }
    
    /**
     * 添加或编辑
     * 
     * @author 牧羊人
     * @date 2019-05-06
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::edit()
     */
    function edit()
    {
        $data = request()->param();
        $image = trim($data['image']);
        if (!$data['id'] && !$image) {
            return message('请上传封面', false);
        }
        if (strpos($image, "temp")) {
            $data['image'] = save_image($image, 'layout');
        }
        return parent::edit($data);
    }
    
}