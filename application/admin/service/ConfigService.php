<?php
// +----------------------------------------------------------------------
// | RXThink框架 [ RXThink ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\service;

use app\admin\model\Config as ConfigModel;

/**
 * 配置-服务类
 * 
 * @author 牧羊人
 * @date 2019-04-24
 *
 */
class ConfigService extends BaseService
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-04-24
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new ConfigModel();
    }
    
    /**
     * 获取数据列表
     * 
     * @author 牧羊人
     * @date 2019-05-07
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::getList()
     */
    function getList()
    {
        $param = request()->param();
        
        // 查询条件
        $map = [];
        
        // 配置分组ID
        $group_id = (int)$param['group_id'];
        if ($group_id) {
            $map[] = ['group_id', '=', $group_id];
        }
        
        return parent::getList($map);
        
    }
    
    /**
     * 分组信息编辑
     * 
     * @author zongjl
     * @date 2019-06-02
     */
    function group()
    {
        $data = request()->param();
        
        // 分组ID
        $group_id = (int)$data['group_id'];
        unset($data['group_id']);
        
        if ($data) {
            foreach ($data as $key => $val) {
                if (strpos($key, 'checkbox')) {
                    $item = explode('-', $key);
                    $val = implode(',', array_keys($val));
                }
            }
        }
        
        
        print_r($data);exit;
    }
    
}