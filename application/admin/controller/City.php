<?php

namespace app\admin\controller;

use app\admin\model\City as CityModel;
use app\admin\service\CityService;
use app\admin\validate\City as CityValidate;

// 临时设置最大内存占用为3G
ini_set('memory_limit','3072M');
// 设置脚本最大执行时间 为0 永不过期
set_time_limit(0);

/**
 * 城市-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-07
 *
 */
class City extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-07
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new CityModel();
        $this->service = new CityService();
        $this->validate = new CityValidate();
    }
    
    /**
     * 获取子级【组件调用】
     * 
     * @author 牧羊人
     * @date 2019-05-07
     */
    function getChilds()
    {
        if (IS_POST) {
            $id = input("post.id", 0);
            $list = $this->model->getChilds($id);
            return message('操作成功', true, $list);
        }
    }
}