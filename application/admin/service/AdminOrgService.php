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

use app\admin\model\AdminOrg as AdminOrgModel;

/**
 * 组织机构-服务类
 * @author 牧羊人
 * @date 2019/5/7
 * Class AdminOrgService
 * @package app\admin\service
 */
class AdminOrgService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AdminOrgModel();
    }

    /**
     * 添加或编辑
     * @return Ambigous
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function edit()
    {
        $data = request()->param();

        // 公司LOGO
        $logo = trim($data['logo']);
        if (strpos($logo, "temp")) {
            $data['logo'] = save_image($logo, 'admin_org');
        }
        return parent::edit($data);
    }
}
