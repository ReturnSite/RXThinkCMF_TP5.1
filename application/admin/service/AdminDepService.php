<?php

namespace app\admin\service;

use app\admin\model\AdminDep as AdminDepModel;

/**
 * 部门-服务类
 * @author 牧羊人
 * @date 2019/5/7
 * Class AdminDepService
 * @package app\admin\service
 */
class AdminDepService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AdminDepModel();
    }
    
    /**
     * 获取数据列表
     * @return array 返回结果
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function getList()
    {
        $list = $this->model->getChilds(0, 1);
        return message('操作成功', true, $list);
    }
}
