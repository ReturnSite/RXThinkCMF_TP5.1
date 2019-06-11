<?php

namespace app\admin\service;

use app\admin\model\Attachment as AttachmentModel;

/**
 * 附件-服务类
 * @author 牧羊人
 * @date 2019/5/9
 * Class AttachmentService
 * @package app\admin\service
 */
class AttachmentService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/9
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new AttachmentModel();
    }
}
