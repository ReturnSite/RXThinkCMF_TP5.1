<?php

namespace app\admin\service;

use app\admin\model\Item as ItemModel;

/**
 * 站点=服务类
 * @author 牧羊人
 * @date 2019/5/5
 * Class ItemService
 * @package app\admin\service
 */
class ItemService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/5
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ItemModel();
    }

    /**
     * 添加或编辑
     * @return array
     * @author 牧羊人
     * @date 2019/5/5
     */
    public function edit()
    {
        $data = request()->param();

        // 图片处理
        $image = trim($data['image']);
        if (!$data['id'] && !$image) {
            return message('请上传站点图片', false);
        }
        if (strpos($image, "temp")) {
            $data['image'] = save_image($image, 'item');
        }
        return parent::edit($data);
    }
}
