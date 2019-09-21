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
 * 用户分组-模型
 * @author 牧羊人
 * @date 2019/5/8
 * Class UserGroup
 * @package app\admin\model
 */
class UserGroup extends BaseModel
{
    // 设置数据表
    protected $table = 'think_user_group';

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/8
     */
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 获取缓存信息
     * @param int $id 记录ID
     * @return mixed 返回结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @date 2019/5/8
     */
    public function getInfo($id)
    {
        $info = parent::getInfo($id, true);
        if ($info) {
            // TODO...
        }
        return $info;
    }
}
