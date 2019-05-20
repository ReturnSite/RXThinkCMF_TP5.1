<?php

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 文章-模型
 * 
 * @author 牧羊人
 * @date 2019-05-08
 *
 */
class Article extends BaseModel
{
    // 设置数据表
    protected $table = 'think_article';
    
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TOOD...
    }
    
    /**
     * 获取缓存信息
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::getInfo()
     */
    function getInfo($id)
    {
        $info = parent::getInfo($id);
        if ($info) {
            
            // 文章封面
            if ($info['cover']) {
                $info['cover_url'] = get_image_url($info['cover']);
            }
            
            // 获取栏目
            if ($info['cate_id']) {
                $item_cate_model = new ItemCate();
                $item_cate_info = $item_cate_model->getInfo($info['cate_id']);
                $info['cate_name'] = $item_cate_info['item_name'] . ">>" . $item_cate_info['name'];
            }
            
            // 获取分表
            $table = $this->get_article_table($id, false);
            $article_model = db($table);
            $article_info = $article_model->find($id);
            if ($article_info['content']) {
                while(strstr($article_info['content'], "[IMG_URL]")){
                    $article_info['content'] = str_replace("[IMG_URL]", IMG_URL, $article_info['content']);
                }
            }
            $info = array_merge($info, $article_info);
            
            // 文章图集
            if ($info['imgs']) {
                $imgs_list =  unserialize($info['imgs']);
                foreach ($imgs_list as &$val) {
                    $val = get_image_url($val);
                }
                $info['imgs_list'] = $imgs_list;
            }
            
        }
        return $info;
    }
    
    /**
     * 添加或编辑
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * (non-PHPdoc)
     * @see \app\common\model\BaseModel::edit()
     */
    function edit($data = [], &$error = '', $is_sql = false)
    {
        // 获取数据表字段
        $column = $this->getTableFields();
        
        $item = [];
        foreach ($data as $key => $val){
            if (!in_array($key, $column)) {
                $item[$key] = $val;
                unset($data[$key]);
            }
        }
        
        //开启事务
        $this->startTrans();
        $rowId = parent::edit($data, $error, $is_sql);
        if (!$rowId) {
            //事务回滚
            $this->rollback();
            return false;
        }
        $result = $this->save_article_info($rowId, $item);
        if (!$result) {
            
            //事务回滚
            $this->rollback();
            return false;
        }
        //提交事务
        $this->commit();
        return $rowId;
    }
    
    /**
     * 保存附表信息
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * @param unknown $id 文章ID
     * @param unknown $item 附表信息
     */
    function save_article_info($id, $item)
    {
        $table = $this->get_article_table($id);
        $info = $this->where(['id'=>$id])->table($table)->find();

        $data = [];
        if (!$info) {
            $data['id'] = $id;
        }
        $data['content'] = $item['content'];
        if ($item['guide']) {
            $data['guide'] = $item['guide'];
        }
        if ($item['imgs']) {
            $data['imgs'] = $item['imgs'];
        }
        
        //获取分表模型
        $table = $this->get_article_table($id, false);
        $article_model = db($table);
        if ($info['id']) {
            $result = $article_model->where('id', $id)->update($data);
        }else{
            $result = $article_model->insert($data);
        }
        if ($result !== false) {
            return true;
        }
        return false;
    }
    
    /**
     * 获取文章附表名
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * @param unknown $id 文章ID
     * @param string $is_prefix 是否包含表前缀
     * @return string 输出表名
     */
    function get_article_table($id, $is_prefix = true)
    {
        $table = substr($id, -1 , 1);
        $table = "article_{$table}";
        if ($is_prefix) {
            $table = DB_PREFIX . $table;
        }
        return $table;
    }
    
}