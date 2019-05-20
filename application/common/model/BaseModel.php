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

namespace app\common\model;

use app\admin\model\Admin as AdminModel;

/**
 * 业务基类模型
 *
 * @author 牧羊人
 * @date 2019-03-27
 */
class BaseModel extends CommonModel
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-03-27
     * (non-PHPdoc)
     * @see \think\Model::initialize()
     */
    function initialize()
    {
        parent::initialize();
        //TODO...
    }
    
    /**
     * 添加或编辑
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function edit($data = [], &$error = '', $is_sql = false)
    {
        // 基础参数设置
        $id = isset($data['id']) ? (int)$data['id'] : 0;
        if ($id) {
            if (empty($data['update_time'])) {
                $data['update_time'] = time();
            }
            if (empty($data['update_user'])) {
                $data['update_user'] = session('admin_id');
            }
        } else {
            if (empty($data['create_time'])) {
                $data['create_time'] = time();
            }
            if (empty($data['create_user'])) {
                $data['create_user'] = session('admin_id');
            }
        }
        
        // 格式化表数据
        $this->formatData($data, $id);
        
        // 入库处理
        if ($id) {
            //修改数据
            $result = $this->update($data, ['id' => $id]);
            // 打印SQL
            if ($is_sql) echo $this->getLastSql();
            // 更新ID
            $rowId = $id;
        } else {
            // 新增数据
            $result = $this->insertGetId($data);
            // 打印SQL
            if ($is_sql) echo $this->getLastSql();
            // 新增ID
            $rowId = $result;
        }
        if ($result !== false) {
            // 重置缓存
            $data['id'] = $rowId;
            $this->_cacheReset($rowId, $data, $id);
        }
        return $rowId;
    }
    
    /**
     * 删除记录
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function drop($id, $is_sql = false)
    {
        $result = $this->where([
            'id'=>$id,
        ])->setField('mark','0');
        // 打印SQL
        if ($is_sql) echo $this->getLastSql();
        if ($result!==false) {
            //删除成功
            $this->_cacheDelete($id);
        }
        return $result;
    }
    
    /**
     * 获取缓存信息
     *
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getInfo($id)
    {
        $this->_cacheDelete($id);
        $info = $this->getCacheFunc("info", $id);
        if ($info) {

            // 添加时间
            if (isset($info['create_time']) && $info['create_time']) {
                $info['format_create_time'] = date('Y-m-d H:i:s',$info['create_time']);
            }
    
            //更新时间
            if (isset($info['update_time']) && $info['update_time']) {
                $info['format_update_time'] = date('Y-m-d H:i:s',$info['update_time']);
            }
            
            // 创建人
            if (isset($info['create_user']) && $info['create_user']) {
                $admin_model = new AdminModel();
                $admin_info = $admin_model->field('realname')->where('id', $info['create_user'])->find()->toArray();
                $info['format_create_user'] = $admin_info['realname'];
            }
            
            // 更新人
            if (isset($info['update_user']) && $info['update_user']) {
                $admin_model = new AdminModel();
                $admin_info = $admin_model->field('realname')->where('id', $info['update_user'])->find()->toArray();
                $info['format_update_user'] = $admin_info['realname'];
            }
            
            // 格式化信息
            if (method_exists($this, 'formatInfo')) {
                $info = $this->formatInfo($info);
            }
    
        }
        return $info;
    }
    
    /**
     * 格式化信息
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function formatInfo($info)
    {
        // TODO...
        return $info;
    }
    
    /**
     * 查询记录总数
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getCount($map = [], $fields = null, $is_sql = false)
    {
        //查询条件
        if (is_array($map)) {
            $map[] = ['mark', '=', 1];
        } else if ($map){
            $map .= " AND mark=1 ";
        } else {
            $map .= " mark=1 ";
        }
        if ($fields) {
            $count = $this->where($map)->count($fields);
        } else {
            $count = $this->where($map)->count();
        }
        // 打印SQL
        if ($is_sql) echo $this->getLastSql();
        return (int)$count;
    }
    
    /**
     * 获取某个字段的求和值
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getSum($map = [], $field, $is_sql = false)
    {
        //查询条件
        if (is_array($map)) {
            $map[] = ['mark', '=', 1];
        } else if ($map){
            $map .= " AND mark=1 ";
        } else {
            $map .= " mark=1 ";
        }
        $result = $this->where($map)->sum($field);
        // 打印SQL
        if ($is_sql) echo $this->getLastSql();
        return $result;
    }
    
    /**
     * 获取某个字段的最大值
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getMax($map = [], $field, $force = true, $is_sql = false)
    {
        //查询条件
        if (is_array($map)) {
            $map[] = ['mark', '=', 1];
        } else if ($map){
            $map .= " AND mark=1 ";
        } else {
            $map .= " mark=1 ";
        }
        $result = $this->where($map)->max($field, $force);
        // 打印SQL
        if ($is_sql) echo $this->getLastSql();
        return $result;
    }
    
    /**
     * 获取某个字段的最小值
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getMin($map = [], $field, $force = true, $is_sql = false)
    {
        //查询条件
        if (is_array($map)) {
            $map[] = ['mark', '=', 1];
        } else if ($map){
            $map .= " AND mark=1 ";
        } else {
            $map .= " mark=1 ";
        }
        $result = $this::where($map)->min($field, $force);
        // 打印SQL
        if ($is_sql) echo $this->getLastSql();
        return $result;
    }
    
    /**
     * 获取某个字段的平均值
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getAvg($map = [], $field, $is_sql = false)
    {
        // 查询条件
        if (is_array($map)) {
            $map[] = ['mark', '=', 1];
        } else if ($map){
            $map .= " AND mark=1 ";
        } else {
            $map .= " mark=1 ";
        }
        $result = $this->where($map)->avg($field);
        // 打印SQL
        if ($is_sql) echo $this->getLastSql();
        return $result;
    }
    
    /**
     * 获取某个字段的值
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getValue($map = [], $field = 'id', $is_sql = false)
    {
        // 查询条件
        if (is_array($map)) {
            $map[] = ['mark', '=', 1];
        } else if ($map){
            $map .= " AND mark=1 ";
        } else {
            $map .= " mark=1 ";
        }
        $result = $this::where($map)->value($field);
        // 打印SQL
        if ($is_sql) echo $this->getLastSql();
        return $result;
    }
    
    /**
     * 查询单条记录
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getOne($map = [], $field = true, $is_sql = false)
    {
        // 查询条件
        if (is_array($map)) {
            $map[] = ['mark', '=', 1];
        } else if ($map){
            $map .= " AND mark=1 ";
        } else {
            $map .= " mark=1 ";
        }
        $result = $this::where($map)->field($field)->find();
        // 打印SQL
        if ($is_sql) echo $this->getLastSql();
        return $result ? $result->toArray() : [];
    }
    
    /**
     * 根据ID获取某一行的值
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getRow($id, $field = true, $is_sql = false)
    {
        $result = $this::where('id', $id)->field($field)->find()->toArray();
        // 打印SQL
        if ($is_sql) $this->getLastSql();
        return $result;
    }
    
    /**
     * 获取某一列的值
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getColumn($map = [], $field, $key = '', $is_sql = false)
    {
        if ($key) {
            $result = $this->where($map)->column($field, $key);
        } else {
            $result = $this->where($map)->column($field);
        }
        // 打印SQL
        if ($is_sql) echo $this->getLastSql();
        return $result;
    }
    
    /**
     * 查询多条记录
     *
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getList($map = [], $order = 'id DESC', $offset = 0, $limit = 10000, $is_sql = false)
    {
        // 查询条件
        if (is_array($map)) {
            $map[] = ['mark', '=', 1];
        } else if ($map){
            $map .= " AND mark=1 ";
        } else {
            $map .= " mark=1 ";
        }
        $result = [];
        $list = $this->where($map)->order($order)->limit($offset, $limit)->column("id");
        // 打印SQL
        if ($is_sql) echo $this->getLastSql();
        if (!$list) {
            return $result;
        }
        foreach ($list as $val) {
            $info = $this->getInfo($val);
            if (!$info) continue;
            $result[] = $info;
        }
        return $result;
    }
    
    /**
     * 获取全部数据表
     *
     * @author 牧羊人
     * @date 2019-05-09
     */
    final function get_tables_list()
    {
        $tables = [];
        $database = strtolower(config('database.database'));
        $sql = 'SHOW TABLES';
        $data = $this->query($sql);
        foreach ($data as $v) {
            $tables[] = $v["Tables_in_{$database}"];
        }
        return $tables;
    }
    
    /**
     * 检查表是否存在
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * @param unknown $table 数据表名
     * @return boolean 返回BOOL值
     */
    final function table_exist($table)
    {
        $tables = $this->list_tables();
        return in_array(DB_PREFIX . $table, $tables) ? true : false;
    }
    
    /**
     * 删除数据表
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * @param unknown $table 数据表名
     */
    final function drop_table($table)
    {
        if (strpos($table, DB_PREFIX) === false) {
            $table = DB_PREFIX . $table;
        }
        return $this->query("DROP TABLE {$table}");
    }
    
    /**
     * 获取数据表字段
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * @param unknown $table 数据表名
     * @return multitype:unknown
     */
    final function get_table_fields($table)
    {
        if (strpos($table, DB_PREFIX) === false) {
            $table = DB_PREFIX . $table;
        }
        $fields = [];
        $data = $this->query("SHOW COLUMNS FROM {$table}");
        foreach ($data as $v) {
            $fields[$v['Field']] = $v['Type'];
        }
        return $fields;
    }
    
    /**
     * 检查字段是否存在
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * @param unknown $table 数据表名
     * @param unknown $field 字段名
     * @return boolean
     */
    final function field_exist($table, $field)
    {
        $fields = $this->get_table_fields($table);
        return array_key_exists($field, $fields);
    }
    
    /**
     * 插入数据
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * @param unknown $data 数据
     * @param string $is_getId 是否返回主键（默认：true）
     */
    function doInsert($data, $is_getId = true)
    {
        if ($is_getId) {
            // 插入数据并返回主键
            return $this->insertGetId($data);
        } else { 
            // 返回影响数据的条数，没修改任何数据返回 0
            return $this->insert($data);
        }
    }
    
    /**
     * 更新数据
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * @param unknown $data 数据源
     * @param unknown $where 查询条件
     */
    function doUpdate($data, $where)
    {
        return $this->where($where)->update($data);
    }
    
    /**
     * 物理删除数据
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * @param unknown $where 查询条件
     */
    function doDelete($where)
    {
        return $this->where($where)->delete();
    }
    
    /**
     * 逻辑删除数据
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * @param unknown $id 主键ID
     */
    function doMark($id)
    {
        return $this->where('id', $id)->update(['mark' => 0]);
    }
    
}