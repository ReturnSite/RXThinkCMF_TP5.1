<?php

namespace app\admin\service;

use app\admin\model\Article as ArticleModel;

/**
 * 文章-服务类
 * 
 * @author 牧羊人
 * @date 2019-05-08
 *
 */
class ArticleService extends BaseService
{
    /**
     * 初始化模型
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new ArticleModel();
    }
    
    /**
     * 添加或编辑
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * (non-PHPdoc)
     * @see \app\admin\service\BaseService::edit()
     */
    function edit()
    {
        $data = request()->param();
        
        // 文章封面
        $cover = trim($data['cover']);
        if (strpos($cover, "temp")) {
            $data['cover'] = save_image($cover, 'article');
        }
        
        // 文章图集
        $imgs_list = trim($data['imgs']);
        if ($imgs_list) {
            $img_arr = explode(',', $imgs_list);
            foreach ($img_arr as $key => $val) {
                if (strpos($val, "temp")) {
                    //新上传图片
                    $img_str[] = save_image($val, 'article');
                }else{
                    //过滤已上传图片
                    $img_str[] = str_replace(IMG_URL, "", $val);
                }
            }
        }
        $data['imgs'] = serialize($img_str);

        //内容处理
        save_image_content($data['content'], $data['title'], "article");
        
        return parent::edit($data);
    }
    
}