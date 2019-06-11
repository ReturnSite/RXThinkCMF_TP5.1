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
 * 会员-模型
 * @author 牧羊人
 * @date 2019/4/29
 * Class User
 * @package app\admin\model
 */
class User extends BaseModel
{
    // 设置数据表
    protected $table = 'think_user';

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
        $info = parent::getInfo($id);
        if ($info) {
            // 会员头像
            if ($info['avatar']) {
                $info['avatar_url'] = get_image_url($info['avatar']);
            }

            // 二维码
            if ($info['qrcode']) {
                $info['qrcode_url'] = get_image_url($info['qrcode']);
            }

            // 注册时间
            if ($info['register_time']) {
                $info['format_register_time'] = datetime($info['register_time']);
            }

            // 登录时间
            if ($info['login_time']) {
                $info['format_login_time'] = datetime($info['login_time']);
            }
        }
        return $info;
    }
}
