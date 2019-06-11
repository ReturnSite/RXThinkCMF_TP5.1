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

use app\admin\controller\AdminBase;

/**
 * 编辑器组件
 * @author 牧羊人
 * @date 2019/4/28
 * Class Editor
 * @package app\admin\widget
 */
class Editor extends AdminBase
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
     * Kind编辑器组件
     * @param string $type 类型
     * @param string $kindeditorId 编辑器ID
     * @param int $width 宽度
     * @param int $height 高度
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/28
     */
    public function getKindeditor($type, $kindeditorId, $width, $height)
    {
        $width = isset($width) ? $width : 900;
        $height = isset($height) ? $height : 500;

        $rootUrl = str_replace('http://www.', '', trim(SITE_URL, '/'));
        $this->assign('kindeditor_content', isset($_GET['component']) ? $_GET['component'] : '');
        $this->assign('rootUrl', $rootUrl);
        $this->assign('type', $type);
        $this->assign('kindeditorId', $kindeditorId);
        $this->assign('width', $width);
        $this->assign('height', $height);
        return $this->fetch('widget/editor/kindeditor');
    }
}
