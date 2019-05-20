<?php

namespace app\admin\service;

use app\admin\model\ItemCate as ItemCateModel;

/**
 * 栏目-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-05
 *
 */
class ItemCateService extends BaseService
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-05
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new ItemCateModel();
    }
    
    /**
     * 获取数据列表
     * 
     * @author 牧羊人
     * @date 2019-05-05
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::getList()
     */
    function getList()
    {
        $list = $this->model->getChilds(0, 0, 1);
        return message("操作成功", true, $list);
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
        
        $is_cover = $data['is_cover'];
        $cover = trim($data['cover']);
        
        //封面验证
        if ($is_cover == 1 && !$data['id'] && !$cover) {
            return message('请上传栏目封面', false);
        }
        if ($is_cover == 1) {
            if (strpos($cover, "temp")) {
                $data['cover'] = save_image($cover, 'itemCate');
            }
        } else if ($is_cover == 2) {
            $data['cover'] = '';
        }
        return parent::edit($data);
    }
    
}