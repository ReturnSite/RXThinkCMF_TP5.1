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

use think\Model;

/**
 * 基类服务
 * 
 * @author 牧羊人
 * @date 2019-04-10
 *
 */
class BaseService extends Model
{
    // 模型
    protected $model;
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-04-10
     * (non-PHPdoc)
     * @see \app\common\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * 获取数据列表
     * 
     * @author 牧羊人
     * @date 2019-04-10
     */
    function getList()
    {
        // 初始化变量
        $map = [];
        $sort = 'id desc';
        $is_sql = 0;
        
        // 获取参数
        $argList = func_get_args();
        if (!empty($argList)) {
            // 查询条件
            $map = (isset($argList[0]) && !empty($argList[0])) ? $argList[0] : [];
            // 排序
            $sort = (isset($argList[1]) && !empty($argList[1])) ? $argList[1] : 'id desc';
            // 是否打印SQL
            $is_sql = isset($argList[2]) ? isset($argList[2]) : 0;
        }

        // 常规查询条件
        $param = request()->param();
        if ($param) {
            // 筛选名称
            if (isset($param['name']) && $param['name']) {
                $map[] = ['name', 'like', "%{$param['name']}%"];
            }
            
            // 筛选标题
            if (isset($param['title']) && $param['title']) {
                $map[] = ['title', 'like', "%{$param['title']}%"];
            }
            
            // 筛选类型
            if (isset($param['type']) && $param['type']) {
                $map[] = ['type', '=', $param['type']];
            }
            
            // 筛选状态
            if (isset($param['status']) && $param['status']) {
                $map[] = ['status', '=', $param['status']];
            }
            
            // 手机号码
            if (isset($param['mobile']) && $param['mobile']) {
                $map[] = ['mobile', '=', $param['mobile']];
            }
        }
        
        // 设置查询条件
        if (is_array($map)) {
            $map[] = ['mark', '=', 1];
        }else{
            $map .= " AND mark=1 ";
        }
        $result = $this->model->where($map)->order($sort)->page(PAGE,PERPAGE)->column("id");
        
        // 打印SQL
        if ($is_sql) {
            echo $this->model->getLastSql();
        }
        
        $list = [];
        if (is_array($result)) {
            foreach ($result as $val) {
                $info = $this->model->getInfo($val);
                $list[] = $info;
            }
        }
        
        //获取数据总数
        $count = $this->model->where($map)->count();
        
        //返回结果
        $message = array(
            "msg"   => '操作成功',
            "code"  => 0 ,
            "data"  => $list,
            "count" => $count,
        );
        return $message;
    }
    
    /**
     * 添加或编辑
     * 
     * @author 牧羊人
     * @date 2019-04-10
     * @return Ambigous <number, multitype:string unknown >
     */
    function edit()
    {
        // 获取参数
        $argList = func_get_args();
        // 查询条件
        $data = isset($argList[0]) ? $argList[0] : [];
        // 是否打印SQL
        $is_sql = isset($argList[1]) ? $argList[1] : false;
        if (!$data) {
            $data = request()->param();
        }
        $error = '';
        $rowId = $this->model->edit($data, $error, $is_sql);
        if ($rowId) {
            return message();
        }
        return message($error,false);
    }
    
}