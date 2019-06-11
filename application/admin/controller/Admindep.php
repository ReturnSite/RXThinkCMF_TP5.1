<?php

namespace app\admin\controller;

use app\admin\model\AdminDep as AdminDepModel;
use app\admin\service\AdminDepService;
use app\admin\validate\AdminDep as AdminDepValidate;

/**
 * 部门-控制器
 * @author 牧羊人
 * @date 2019/5/7
 * Class Admindep
 * @package app\admin\controller
 */
class Admindep extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AdminDepModel();
        $this->service = new AdminDepService();
        $this->validate = new AdminDepValidate();
    }

    /**
     * 添加或编辑
     * @return mixed
     * @author 牧羊人
     * @date 2019/5/7
     */
    public function edit()
    {
        $pid = input("get.pid", 0);
        if ($pid) {
            $info = $this->model->getInfo($pid);
        }
        return parent::edit([
            'parent_id' => $pid,
            'parent_name' => isset($info['name']) ? $info['name'] : '',
        ]);
    }
}
