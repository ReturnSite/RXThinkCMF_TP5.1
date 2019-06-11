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

use app\admin\model\Article as ArticleModel;

/**
 * 文章-服务类
 * @author 牧羊人
 * @date 2019/5/8
 * Class ArticleService
 * @package app\admin\service
 */
class ArticleService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/8
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ArticleModel();
    }

    /**
     * 添加或编辑
     * @return Ambigous
     * @author 牧羊人
     * @date 2019/5/8
     */
    public function edit()
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
                } else {
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
