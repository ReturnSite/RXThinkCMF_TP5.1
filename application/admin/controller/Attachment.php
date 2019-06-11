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

use app\admin\model\Attachment as AttachmentModel;
use app\admin\service\AttachmentService;
use app\admin\validate\Attachment as AttachmentValidate;

/**
 * 附件-控制器
 * @author 牧羊人
 * @date 2019/5/9
 * Class Attachment
 * @package app\admin\controller
 */
class Attachment extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/5/9
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AttachmentModel();
        $this->service = new AttachmentService();
        $this->validate = new AttachmentValidate();
    }
}
