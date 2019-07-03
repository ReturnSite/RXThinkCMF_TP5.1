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

use app\admin\model\ItemCate as ItemCateModel;

/**
 * 栏目-服务类
 * @author 牧羊人
 * @date 2019/5/5
 * Class ItemCateService
 * @package app\admin\service
 */
class ItemCateService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/5
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ItemCateModel();
    }

//    /**
//     * 获取数据列表
//     * @return array
//     * @author 牧羊人
//     * @date 2019/5/5
//     */
//    public function getList()
//    {
//        $list = $this->model->getChilds(0, 0, 1);
//        return message("操作成功", true, $list);
//    }

    /**
     * 添加或编辑
     * @return array
     * @author 牧羊人
     * @date 2019/5/5
     */
    public function edit()
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
        } elseif ($is_cover == 2) {
            $data['cover'] = '';
        }
        return parent::edit($data);
    }
}
