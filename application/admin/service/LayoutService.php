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

use app\admin\model\Layout as LayoutModel;

/**
 * 布局-服务类
 * @author 牧羊人
 * @date 2019/5/6
 * Class LayoutService
 * @package app\admin\service
 */
class LayoutService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/6
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new LayoutModel();
    }

    /**
     * 添加或编辑
     * @return array
     * @author 牧羊人
     * @date 2019/5/6
     */
    public function edit()
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
