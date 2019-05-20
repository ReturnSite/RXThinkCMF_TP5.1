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

/**
 * 功能节点挂件
 * 
 * @author 牧羊人
 * @date 2019-04-22
 *
 */
class Func extends AdminWidget
{
    /**
     * 初始化方法
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * (non-PHPdoc)
     * @see \app\admin\widget\AdminWidget::initialize()
     */
    function initialize()
    {
        parent::initialize();
        // TODO...
    }
    
    /**
     * 新增节点
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * @param unknown $funcName 节点名称
     * @param unknown $param 参数
     * @return \think\mixed
     */
    function btnAdd($funcName, $param = [])
    {
        $this->assign('param', json_encode($param));
        return $this->btnFunc("add", 'layui-icon-add-1', $funcName);
    }
    
    /**
     * 删除节点
     *
     * @author 牧羊人
     * @date 2019-04-22
     * @param unknown $funcName 节点名称
     * @return \think\mixed
     */
    function btnDel($funcName)
    {
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/drop");
    }
    
    /**
     * 修改节点
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * @param unknown $funcName 节点名称
     * @return \think\mixed
     */
    function btnEdit($funcName)
    {
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/edit");
    }
    
    /**
     * 查询节点
     * 
     * @author 牧羊人
     * @date 2019-05-11
     * @param unknown $funcName 节点名称
     * @return \think\mixed
     */
    function btnQuery($funcName)
    {
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/query");
    }
    
    /**
     * 详情节点
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * @param unknown $funcName 节点名称
     * @return \think\mixed
     */
    function btnDetail($funcName)
    {
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/detail");
    }
    
    /**
     * 重置缓存节点
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * @param unknown $funcName 节点名称
     * @return \think\mixed
     */
    function btnCache($funcName)
    {
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/cache");
    }
    
    /**
     * 一键复制
     * 
     * @author 牧羊人
     * @date 2019-05-09
     * @param unknown $funcName 节点名称
     * @return \think\mixed
     */
    function btnCopy($funcName)
    {
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/copy");
    }
    
    /**
     * 添加子级节点
     *
     * @author 牧羊人
     * @date 2019-04-22
     * @return \think\mixed
     */
    function btnAdd2()
    {
        return $this->fetch("widget/func/add");
    }
    
    /**
     * 设置权限节点
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * @param unknown $funcName 节点名称
     * @return \think\mixed
     */
    function btnAuth($funcName)
    {
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/auth");
    }
    
    /**
     * 导出节点
     * 
     * @author 牧羊人
     * @date 2019-05-16
     * @param unknown $funcName 节点名称
     */
    function btnExport($funcName)
    {
        return $this->btnFunc("export", 'layui-icon-share', $funcName, "layui-btn-normal");
    }
    
    /**
     * 导入节点
     * 
     * @author 牧羊人
     * @date 2019-05-16
     * @param unknown $funcName 节点名称
     */
    function btnImport($funcName)
    {
        return $this->btnFunc("import", 'layui-icon-share', $funcName, "layui-btn-normal");
    }
    
    /**
     * 立即备份
     * 
     * @author 牧羊人
     * @date 2019-05-16
     * @param unknown $funcName 节点名称
     */
    function btnBackup($funcName)
    {
        return $this->btnFunc("backup", 'yun-yunzhujibeifen', $funcName, "layui-btn-normal");
    }
    
    /**
     * 优化表
     * 
     * @author 牧羊人
     * @date 2019-05-16
     * @param unknown $funcName 节点名称
     */
    function btnOptimize($funcName)
    {
        return $this->btnFunc("optimize", 'yun-anquanbaozhang', $funcName, "layui-btn-normal");
    }
    
    /**
     * 立即修复
     * 
     * @author 牧羊人
     * @date 2019-05-16
     * @param unknown $funcName 节点名称
     */
    function btnRepair($funcName)
    {
        return $this->btnFunc("repair", 'yun-weixiu', $funcName, "layui-btn-normal");
    }
    
    /**
     * 批量删除节点
     *
     * @author 牧羊人
     * @date 2019-04-22
     * @param unknown $funcName 节点名称
     * @return \think\mixed
     */
    function btnDAll($funcName)
    {
        return $this->btnFunc("batchDrop", 'layui-icon-delete', $funcName, "layui-btn-danger");
    }
    
    /**
     * 批量重置缓存节点
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * @param unknown $funcName 节点名称
     * @return \think\mixed
     */
    function btnCAll($funcName)
    {
        return $this->btnFunc("batchCache", 'layui-icon-set-fill', $funcName, "layui-btn-normal");
    }

    /**
     * 批量启用
     * 
     * @author 牧羊人
     * @date 2019-05-15
     * @param unknown $funcName 节点名称
     */
    function btnEAll($funcName)
    {
        return $this->btnFunc("batchEnable", 'layui-icon-play', $funcName, "layui-btn-warm",1,['status=1']);
    }
    
    /**
     * 批量禁用
     * 
     * @author 牧羊人
     * @date 2019-05-15
     * @param unknown $funcName 节点名称
     */
    function btnSAll($funcName)
    {
        return $this->btnFunc("batchDisable", 'layui-icon-pause', $funcName, "layui-btn-danger",1,['status=2']);
    }
    
    /**
     * 按钮节点
     * 
     * @author 牧羊人
     * @date 2019-04-22
     * @param unknown $funcAct 节点标识
     * @param unknown $funcIcon 节点Icon
     * @param unknown $funcName 节点名称
     * @param string $funcColor 节点背景色
     * @param number $funcType 节点类型：1大按钮 2小按钮
     * @param unknown $param 参数
     * @return \think\mixed
     */
    function btnFunc($funcAct, $funcIcon, $funcName, $funcColor='', $funcType=1, $param=[])
    {
        $this->assign('funcAct', $funcAct);
        $this->assign('funcIcon', $funcIcon);
        $this->assign('funcName', $funcName);
        $this->assign('funcColor', $funcColor);
        $this->assign('funcType', $funcType);
        $this->assign('param', json_encode($param));
        return $this->fetch('widget/func/func');
    }
    
}