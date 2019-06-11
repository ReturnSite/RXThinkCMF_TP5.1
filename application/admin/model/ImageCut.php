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

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 切图-模型
 * @author zongjl
 * @date 2019/6/11
 * Class ImageCut
 * @package app\admin\model
 */
class ImageCut extends BaseModel
{
    // 设置数据表
    protected $table = "think_image_cut";

    /**
     * 初始化模型
     * @author zongjl
     * @date 2019/6/11
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }

    /**
     * 获取缓存信息
     * @param int $id 记录ID
     * @return mixed 返回结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author zongjl
     * @date 2019/6/11
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id);
        if ($info) {
            // 切图类型
            if ($info['type']) {
                $info['type_name'] = config('config.image_cut_type')[$info['type']];
            }
        }
        return $info;
    }
}
