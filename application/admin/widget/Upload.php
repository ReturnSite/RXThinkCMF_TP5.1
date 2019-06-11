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

namespace app\admin\widget;

/**
 * 上传文件-组件
 * @author 牧羊人
 * @date 2019/4/28
 * Class Upload
 * @package app\admin\widget
 */
class Upload extends AdminWidget
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
     * 单图上传组件
     * @param string $name 组件对应的数据库名称
     * @param string $img_url 组件图片地址
     * @param string $size 组件图片区域尺寸
     * @param string $title 组件按钮标题
     * @param string $size_tips 建议上传尺寸提示
     * @param string $crop_size 图片裁剪尺寸
     * @param string $crop_rate 图片旋转率
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/28
     */
    public function uploadSingleImage($name, $img_url, $size = '90x90', $title = null, $size_tips = null, $crop_size = null, $crop_rate = null)
    {
        // 图片默认显示尺寸：90x90
        $size = $size ? $size : '90x90';
        $title = $title ? $title : "图片";
        $is_crop = isset($crop_size) ? 1 : 2;
        $crop_size = isset($crop_size) ? $crop_size : '300x300'; //默认裁剪尺寸 300x300
        $crop_rate = isset($crop_rate) ? $crop_rate : 1 / 1;

        //长宽
        $size_arr = explode('x', $size);
        //裁剪尺寸
        $crop_arr = explode('x', $crop_size);

        $this->assign('name', $name);
        $this->assign('img_url', $img_url);
        $this->assign('img_hidden', str_replace(IMG_URL, '', $img_url));
        $this->assign('img_width', $size_arr[0]);
        $this->assign('img_height', $size_arr[1]);
        $this->assign('title', $title);
        $this->assign('size_tips', $size_tips);
        $this->assign('crop_width', $crop_arr[0]);
        $this->assign('crop_height', $crop_arr[1]);
        $this->assign('crop_rate', $crop_rate);
        $this->assign('is_crop', $is_crop);
        return $this->fetch("widget/upload/upload_single_image");
    }

    /**
     * 多图上传组件
     * @param string $name 图片组件对应的数据库字段名称
     * @param array $img_list 图片地址数组
     * @param string $img_tips 鼠标悬停图片提示语
     * @param string $size 图片显示区域尺寸
     * @param int $max_num 多图组件最大上传图片数
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/28
     */
    public function uploadMultipleImage($name, $img_list, $img_tips, $size, $max_num = 9)
    {
        //字段名称
        $name = isset($name) ? trim($name) : 'file';
        //长宽
        $size = isset($size) ? trim($size) : '100x100'; //图片尺寸  100 x 100
        $size_arr = explode('x', $size);
        //最大上传张数
        $max_num = $max_num ? $max_num : 5;//默认上传5张

        $this->assign('name', $name);
        $this->assign('max_num', $max_num);
        $this->assign('img_tips', $img_tips);
        $this->assign('img_width', $size_arr[0]);
        $this->assign('img_height', $size_arr[1]);
        $this->assign('img_list', $img_list);
        return $this->fetch("widget/upload/upload_multiple_image");
    }
}
