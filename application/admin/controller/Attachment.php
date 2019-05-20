<?php

namespace app\admin\controller;

use app\admin\model\Attachment as AttachmentModel;
use app\admin\service\AttachmentService;
use app\admin\validate\Attachment as AttachmentValidate;

/**
 * 附件-控制器
 * 
 * @author 牧羊人
 * @date 2019-05-09
 *
 */
class Attachment extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        $this->model = new AttachmentModel();
        $this->service = new AttachmentService();
        $this->validate = new AttachmentValidate();
    }
    
}