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

/**
 * 文件上传-控制器
 * @author 牧羊人
 * @date 2019/4/28
 * Class Upload
 * @package app\admin\controller
 */
class Upload extends AdminBase
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/4/28
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }

    /**
     * 上传图片
     * @return array
     * @author 牧羊人
     * @date 2019/4/28
     */
    public function uploadImage()
    {
        // 设置上传约束
        $config = [
            'size' => 10000000,
            'ext' => 'jpg,gif,png,bmp,jpeg,JPG'
        ];
        $file = $this->request->file('file');
        $upload_path = UPLOAD_TEMP_PATH;
        $info = $file->validate($config)->move($upload_path);
        if ($info) {
            //上传成功
            $file_path = IMG_URL . "/temp/" . $info->getSaveName();
            return message("上传成功", true, $file_path);
        } else {
            //上传失败
            $error = $file->getError();
            return message($error, false);
        }
    }
}
