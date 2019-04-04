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

/**
 * 基类模型
 * 
 * @author 牧羊人
 * @date 2019-03-27
 */
namespace app\common\model;
use think\Model;
use think\facade\Cache;
class BaseModel extends Model
{
    /**
     * 重置缓存函数
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function _cacheReset($id, $data=[], $isEdit=false)
    {
        if(!$data) {
            $this->resetCacheFunc('info', $id);
        }
        if($isEdit) {
            $info = $this->getCacheFunc("info", $id);
        }
        $info = $info ? $info : [];
        if(is_array($data)) {
            $info = array_merge($info, $data);
        }else{
            $info = $data;
        }
        $cacheKey = $this->getCacheKey('info',$id);
        $result = $this->setCache($cacheKey, $info);
        return $result;
    }
    
    /**
     * 删除缓存
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function _cacheDelete($id)
    {
        $cacheKey = $this->getCacheKey("info",$id);
        $result = $this->deleteCache($cacheKey);
        return $result;
    }
    
    /**
     * 获取缓存
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function _cacheInfo($id)
    {
        if(!$id) {
            return false;
        }
        $data = $this->get((int)$id)->toArray();
        return $data;
    }
    
    /**
     * 重置缓存函数
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function resetCacheFunc($funcName, $id='')
    {
        $cacheKey = $this->getCacheKey($funcName,$id);
        $result = $this->deleteCache($cacheKey);
        return $result;
    }
    
    /**
     * 获取缓存函数
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getCacheFunc($funcName, $id)
    {
        $argList = func_get_args();
        $cacheKey = $this->getCacheKey($funcName,$id);
        $data = $this->getCache($cacheKey);
        if(!$data) {
            if($this->name) {
                array_shift($argList);
            }
            $act = "_cache".ucfirst($funcName);
            $data = call_user_func_array(array($this, $act), $argList);
            $this->setCache($cacheKey, $data);
        }
        return $data;
    }
    
    /**
     * 获取缓存KEY
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getCacheKey()
    {
        $argList = func_get_args();
        if ($this->name) {
            array_unshift($argList, 'yk_' . $this->name);
        }
        $cacheKey = implode("_", $argList);
        return $cacheKey;
    }
    
    /**
     * 设置缓存
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function setCache($cacheKey, $data, $ttl=0)
    {
        
        if(!$data) {
            return false;
        }
        $isGzcompress = gzcompress(json_encode($data));
        if($isGzcompress) {
            $result =  Cache::set($cacheKey, $isGzcompress, $ttl);
        }
        return $result;
    }
    
    /**
     * 获取缓存
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getCache($cacheKey)
    {
        $data = Cache::get($cacheKey);
        if($data) {
            $data = json_decode(gzuncompress($data),true);
        }
        return $data;
    }
    
    /**
     * 删除缓存
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function deleteCache($cacheKey)
    {
        if(Cache::has($cacheKey)) {
            return Cache::rm($cacheKey);
        }
        return false;
    }
    
    /**
     * 格式化表数据
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function formatData(&$data=[], $id=0, $table='')
    {
        $dataList = array();
        $tables = $table ? explode(",", $table) : array($this->getTable());
        $newData = array();
        foreach ($tables as $table) {
            $tempData = array();
            $fieldInfoList = $this->getTableFieldInfo($table);
            foreach ($fieldInfoList as $field=>$fieldInfo) {
                if ($field == "id") continue;
                //对强制
                if (isset($data[$field])) {
                    if ($fieldInfo['Type']=="int") {
                        $newData[$field] = (int) $data[$field];
                    } else {
                        $newData[$field] = (string) $data[$field];
                    }
                }
                if (!isset($data[$field]) && in_array($field, array('upd_time','add_time'))) {
                    continue;
                }
                //插入数据-设置默认值
                if (!$id && !isset($data[$field])) {
                    $newData[$field] = $fieldInfo['Default'];
                }
                if (isset($newData[$field])) {
                    $tempData[$field] = $newData[$field];
                }
            }
            $dataList[] = $tempData;
        }
        $data = $newData;
        return $dataList;
    }
    
    /**
     * 获取表字段
     * 
     * @author 牧羊人
     * @date 2019-03-27
     */
    function getTableFieldInfo($table='')
    {
        $table = $table ? $table : $this->getTable();
        $fieldList = $this->query("SHOW FIELDS FROM {$table}");
        $infoList = array();
        foreach ($fieldList as $row) {
            if ((strpos($row['Type'], "int") === false) || (strpos($row['Type'], "bigint") !== false)) {
                $type = "string";
                $default = $row['Default'] ? $row['Default'] : "";
            } else {
                $type = "int";
                $default = $row['Default'] ? $row['Default'] : 0;
            }
            $infoList[$row['Field']] = array(
                'Type'=>$type,
                'Default'=>$default
            );
        }
        return $infoList;
    }
    
}