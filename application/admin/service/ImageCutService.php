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

namespace app\admin\service;

use app\admin\service\BaseService;
use app\admin\model\ImageCut as ImageCutModel;

/**
 * 切图-服务类
 * @author 牧羊人
 * @date 2019/5/9
 * Class ImageCutService
 * @package app\admin\service
 */
class ImageCutService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/9
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ImageCutModel();
    }
}
