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

namespace app\admin\controller;

use app\admin\model\Article as ArticleModel;
use app\admin\service\ArticleService;
use app\admin\validate\Article as ArticleValidate;

/**
 * 文章-控制器
 * @author 牧羊人
 * @date 2019/5/8
 * Class Article
 * @package app\admin\controller
 */
class Article extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/8
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ArticleModel();
        $this->service = new ArticleService();
        $this->validate = new ArticleValidate();
    }
}
