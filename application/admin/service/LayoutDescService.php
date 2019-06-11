<?php

namespace app\admin\service;

use app\admin\model\LayoutDesc;

/**
 * 布局描述-服务类
 * @author 牧羊人
 * @date 2019/5/5
 * Class LayoutDescService
 * @package app\admin\service
 */
class LayoutDescService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/5
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new LayoutDesc();
    }
}
