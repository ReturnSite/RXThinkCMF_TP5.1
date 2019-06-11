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

use app\admin\model\Action as ActionModel;

/**
 * 行为-服务类
 * @author 牧羊人
 * @date 2019/5/14
 * Class ActionService
 * @package app\admin\service
 */
class ActionService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/14
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ActionModel();
    }
    
    /**
     * 获取数据列表
     * @return array
     * @author 牧羊人
     * @date 2019/5/14
     */
    public function getList()
    {
        $param = request()->param();

        // 查询
        $map = [];

        // 来源类型
        $source_type = (int)$param['source_type'];
        if ($source_type) {
            $map[] = ['source_type', '=', $source_type];
        }

        return parent::getList($map);
    }
}
