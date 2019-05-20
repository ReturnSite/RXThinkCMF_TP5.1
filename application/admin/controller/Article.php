<?php

namespace app\admin\controller;

use app\admin\model\Article as ArticleModel;
use app\admin\service\ArticleService;
use app\admin\validate\Article as ArticleValidate;

/**
 * 文章-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-08
 *
 */
class Article extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new ArticleModel();
        $this->service = new ArticleService();
        $this->validate = new ArticleValidate();
    }
}