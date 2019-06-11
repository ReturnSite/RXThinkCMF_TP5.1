<?php

namespace app\admin\service;

use app\admin\model\Ad as AdModel;

/**
 * 广告-服务类
 * @author 牧羊人
 * @date 2019/5/6
 * Class AdService
 * @package app\admin\service
 */
class AdService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/6
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AdModel();
    }

    /**
     * 添加或编辑
     * @return Ambigous
     * @author 牧羊人
     * @date 2019/5/6
     */
    public function edit()
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
