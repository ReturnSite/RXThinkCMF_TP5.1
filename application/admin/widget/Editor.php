<?php
// +----------------------------------------------------------------------
// | RXThink框架 [ RXThink ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2019 南京RXThink工作室
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <rxthink@gmail.com>
// +----------------------------------------------------------------------

namespace app\admin\widget;

use app\admin\controller\AdminBase;

/**
 * 编辑器组件
 * 
 * @author 牧羊人
 * @date 2019-04-28
 *
 */
class Editor extends AdminBase
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-04-28
     * (non-PHPdoc)
     * @see \app\admin\controller\AdminBase::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * Kind编辑器组件
     * 
     * @author 牧羊人
     * @date 2019-04-28
     * @param unknown $type 编辑器类型
     * @param unknown $kindeditorId 编辑器ID
     * @param unknown $width 编辑器宽度
     * @param unknown $height 编辑器高度
     */
    function get_kindeditor($type, $kindeditorId, $width, $height)
    {
        $width = isset($width) ? $width : 900;
        $height = isset($height) ? $height :500;
        
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