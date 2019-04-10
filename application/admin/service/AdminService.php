<?php
namespace app\admin\service;

use app\common\service\BaseService;

/**
 * 后台服务基类
 * 
 * @author 牧羊人
 * @date 2019-04-10
 * 
 */
class AdminService extends BaseService
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
        // 获取参数
        $argList = func_get_args();
        // 查询条件
        $map = isset($argList[0]) ? $argList[0] : [];
        // 排序
        $sort = isset($argList[1]) ? $argList[1] : 'id DESC';
        
        // 设置查询条件
        if(is_array($map)) {
            $map['mark'] = 1;
        }else{
            $map .= " AND mark=1 ";
        }
        $result = $this->model->where($map)->order($sort)->page(PAGE,PERPAGE)->column("id");
        $list = [];
        if(is_array($result)) {
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
        if(!$data) {
            $data = request()->param();
        }
        $error = '';
        $rowId = $this->model->edit($data, $error,$is_sql);
        if($rowId) {
            return message();
        }
        return message($error,false);
    }
    
}