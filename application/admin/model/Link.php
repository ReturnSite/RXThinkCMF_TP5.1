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
 * 友链-模型
 * @author 牧羊人
 * @date 2019/4/29
 * Class Link
 * @package app\admin\model
 */
class Link extends BaseModel
{
    // 设置数据表
    protected $table = DB_PREFIX . 'link';

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/4/29
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
     * @author 牧羊人
     * @date 2019/4/29
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id, true);
        if ($info) {
            // 友链图片
            if ($info['image']) {
                $info['image_url'] = get_image_url($info['image']);
            }

            // 使用平台
            if ($info['platform']) {
                $info['platform_name'] = config('config.link_platform')[$info['platform']];
            }

            // 友链形式
            if ($info['form']) {
                $info['form_name'] = config('config.link_form')[$info['form']];
            }
        }
        return $info;
    }
}
