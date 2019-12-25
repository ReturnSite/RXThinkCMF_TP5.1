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
 * 功能节点挂件
 * @author 牧羊人
 * @date 2019/4/22
 * Class Func
 * @package app\admin\widget
 */
class Func extends AdminWidget
{
    /**
     * 初始化方法
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function initialize()
    {
        parent::initialize();
        // TODO...
    }

    /**
     * 新增节点
     * @param string $funcName 节点名称
     * @param array $param 节点参数
     * @return \think\mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnAdd($funcName, $param = [])
    {
        $this->assign('param', json_encode($param));
        return $this->btnFunc("add", 'layui-icon-add-1', $funcName);
    }

    /**
     * 删除节点
     * @param string $funcName 节点名称
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnDel($funcName)
    {
        $funcAuth = 'sys:' . strtolower(CONTROLLER_NAME) . ":drop";
        $this->assign('funcAuth', $funcAuth);
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/drop");
    }

    /**
     * 修改节点
     * @param string $funcName 节点名称
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnEdit($funcName)
    {
        $funcAuth = 'sys:' . strtolower(CONTROLLER_NAME) . ":edit";
        $this->assign('funcAuth', $funcAuth);
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/edit");
    }

    /**
     * 查询节点
     * @param string $funcName 节点名称
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnQuery($funcName)
    {
        $funcAuth = 'sys:' . strtolower(CONTROLLER_NAME) . ":index";
        $this->assign('funcAuth', $funcAuth);
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/query");
    }

    /**
     * 详情节点
     * @param string $funcName 节点名称
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnDetail($funcName)
    {
        $funcAuth = 'sys:' . strtolower(CONTROLLER_NAME) . ":detail";
        $this->assign('funcAuth', $funcAuth);
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/detail");
    }

    /**
     * 重置缓存节点
     * @param string $funcName 节点名称
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnCache($funcName)
    {
        $funcAuth = 'sys:' . strtolower(CONTROLLER_NAME) . ":cache";
        $this->assign('funcAuth', $funcAuth);
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/cache");
    }

    /**
     * 一键复制
     * @param string $funcName 节点名称
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnCopy($funcName)
    {
        $funcAuth = 'sys:' . strtolower(CONTROLLER_NAME) . ":copy";
        $this->assign('funcAuth', $funcAuth);
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/copy");
    }

    /**
     * 添加子级节点
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnAdd2()
    {
        $funcAuth = 'sys:' . strtolower(CONTROLLER_NAME) . ":add";
        $this->assign('funcAuth', $funcAuth);
        return $this->fetch("widget/func/add");
    }

    /**
     * 设置权限节点
     * @param string $funcName 节点名称
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnAuth($funcName)
    {
        $funcAuth = 'sys:' . strtolower(CONTROLLER_NAME) . ":setAuth";
        $this->assign('funcAuth', $funcAuth);
        $this->assign('funcName', $funcName);
        return $this->fetch("widget/func/auth");
    }

    /**
     * 导出节点
     * @param string $funcName 节点名称
     * @return \think\mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnExport($funcName)
    {
        return $this->btnFunc("export", 'layui-icon-share', $funcName, "layui-btn-normal");
    }

    /**
     * 导入节点
     * @param string $funcName 节点名称
     * @return \think\mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnImport($funcName)
    {
        return $this->btnFunc("import", 'layui-icon-share', $funcName, "layui-btn-normal");
    }

    /**
     * 立即备份
     * @param string $funcName 节点名称
     * @return \think\mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnBackup($funcName)
    {
        return $this->btnFunc("backup", 'yun-yunzhujibeifen', $funcName, "layui-btn-normal");
    }

    /**
     * 优化表
     * @param string $funcName 节点名称
     * @return \think\mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnOptimize($funcName)
    {
        return $this->btnFunc("optimize", 'yun-anquanbaozhang', $funcName, "layui-btn-normal");
    }

    /**
     * 立即修复
     * @param string $funcName 节点名称
     * @return \think\mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnRepair($funcName)
    {
        return $this->btnFunc("repair", 'yun-weixiu', $funcName, "layui-btn-normal");
    }

    /**
     * 批量删除节点
     * @param string $funcName 节点名称
     * @return \think\mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnDAll($funcName)
    {
        return $this->btnFunc("batchDrop", 'layui-icon-delete', $funcName, "layui-btn-danger");
    }

    /**
     * 批量重置缓存节点
     * @param string $funcName 节点名称
     * @return \think\mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnCAll($funcName)
    {
        return $this->btnFunc("batchCache", 'layui-icon-set-fill', $funcName, "layui-btn-normal");
    }

    /**
     * 批量启用
     * @param string $funcName 节点名称
     * @return \think\mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnEAll($funcName)
    {
        return $this->btnFunc("batchEnable", 'layui-icon-play', $funcName, "layui-btn-warm", 1, ['status=1']);
    }

    /**
     * 批量禁用
     * @param string $funcName 节点名称
     * @return \think\mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnSAll($funcName)
    {
        return $this->btnFunc("batchDisable", 'layui-icon-pause', $funcName, "layui-btn-danger", 1, ['status=2']);
    }

    /**
     * 按钮节点
     * @param string $funcAct 节点标识
     * @param string $funcIcon 节点Icon
     * @param string $funcName 节点名称
     * @param string $funcColor 节点背景色
     * @param int $funcType 节点类型：1大按钮 2小按钮
     * @param array $param 节点参数
     * @return mixed
     * @author 牧羊人
     * @date 2019/4/22
     */
    public function btnFunc($funcAct, $funcIcon, $funcName, $funcColor = '', $funcType = 1, $param = [])
    {
        $funcAuth = 'sys:' . lcfirst(CONTROLLER_NAME) . ":" . $funcAct;
        $this->assign('funcAuth', $funcAuth);
        $this->assign('funcAct', $funcAct);
        $this->assign('funcIcon', $funcIcon);
        $this->assign('funcName', $funcName);
        $this->assign('funcColor', $funcColor);
        $this->assign('funcType', $funcType);
        if (!empty($param)) {
            $this->assign('param', json_encode($param));
        }
        return $this->fetch('widget/func/func');
    }
}
