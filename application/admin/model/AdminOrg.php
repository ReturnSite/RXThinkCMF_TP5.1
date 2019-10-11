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
 * 组织机构-模型
 * @author 牧羊人
 * @date 2019/5/7
 * Class AdminOrg
 * @package app\admin\model
 */
class AdminOrg extends BaseModel
{
    // 设置数据表
    protected $table = DB_PREFIX . 'admin_org';

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/7
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
     * @date 2019/5/7
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id, true);
        if ($info) {
            // 公司LOGO
            if ($info['logo']) {
                $info['logo_url'] = get_image_url($info['logo']);
            }

            // 获取城市
            if ($info['district_id']) {
                $city_model = new City();
                $city_name = $city_model->getCityName($info['district_id'], ">>", true);
                $info['city_name'] = $city_name;
            }

        }
        return $info;
    }
}
