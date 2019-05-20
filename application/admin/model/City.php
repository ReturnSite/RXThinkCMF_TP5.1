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

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 城市-模型
 * 
 * @author 牧羊人
 * @date 2019-04-30
 *
 */
class City extends BaseModel
{
    // 设置数据表
    protected $table = 'think_city';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-04-30
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * 获取缓存信息
     * 
     * @author 牧羊人
     * @date 2019-04-30
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::getInfo()
     */
    function getInfo($id)
    {
        $info = parent::getInfo($id);
        if ($info) {
            // TODO...
        }
        return $info;
    }
    
    /**
     * 获取子级
     * 
     * @author 牧羊人
     * @date 2019-05-07
     */
    function getChilds($parent_id, $flag = false)
    {
        $list = [];
        $result = $this->where([
            'parent_id' =>$parent_id,
            'mark'      =>1
        ])->order("id asc")->select();
        if ($result) {
            foreach ($result as $val) {
                $id = (int)$val['id'];
                $info = $this->getInfo($id);
                if ($flag) {
                    $childList = $this->getChilds($id, $flag);
                    if (is_array($childList)) {
                        $info['children'] = $childList;
                    }
                }
                if ($flag) {
                    $list[] = $info;
                }else{
                    $list[$id] = $info;
                }
            }
        }
        return $list;
    }
    
    /**
     * 获取城市名称
     * 
     * @author 牧羊人
     * @date 2019-05-07
     * @param unknown $city_id 城市ID
     * @param string $delimiter 分隔符(如：>>)
     * @param string $is_replace 是否替换字符
     * @return string 输出城市名称
     */
    function get_city_name($city_id, $delimiter = "", $is_replace = false)
    {
        do {
            $info = $this->getInfo($city_id);
            if ($is_replace){
                $names[] = str_replace(array("省","市","维吾尔","壮族","回族","自治区"), "", $info['name']);
            } else {
                $names[] = $info['name'];
            }
            $city_id = $info['parent_id'];
        } while($city_id > 1);
        $names = array_reverse($names);
        if (strpos($names[1], $names[0]) === 0) {
            unset($names[0]);
        }
        return implode($delimiter, $names);
    }
    
    /**
     * 获取城市缓存
     * 
     * @author 牧羊人
     * @date 2019-05-07
     */
    function getAll()
    {
        return $this->getCacheFunc('all', null);
    }
    
    /**
     * 设置所有缓存
     * 
     * @author 牧羊人
     * @date 2019-05-07
     */
    function _cacheAll()
    {
        return $this->getChilds(1, true);
    }
    
}