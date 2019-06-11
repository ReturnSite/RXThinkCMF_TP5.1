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

use app\admin\model\Link as LinkModel;

/**
 * 友链-服务类
 * @author 牧羊人
 * @date 2019/4/29
 * Class LinkService
 * @package app\admin\service
 */
class LinkService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/4/29
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new LinkModel();
    }

    /**
     * 添加或编辑
     * @return array
     * @author 牧羊人
     * @date 2019/4/29
     */
    public function edit()
    {
        $data = request()->param();
        $image = trim($data['image']);
        $form = (int)$data['form'];

        //字段验证
        if (!$data['id'] && $form == 2 && !$image) {
            return message('请上传图片', false);
        }
        if ($form == 1) {
            //文字
            $data['image'] = '';
        }

        //图片处理
        if (strpos($image, "temp")) {
            $data['image'] = save_image($image, 'link');
        }

        return parent::edit($data);
    }
}
