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

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 行为日志-模型
 * @author 牧羊人
 * @date 2019/4/4
 * Class ActionLog
 * @package app\admin\model
 */
class ActionLog extends BaseModel
{
    // 设置数据表
    protected $table = '';

    // 自定义日志标题
    protected static $title = '';
    // 自定义日志内容
    protected static $content = '';

    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/4/4
     */
    public function initialize()
    {
        parent::initialize();
        // 设置表名
        $this->table = 'think_action_log_' . date('Y') . '_' . date('m');
        // 初始化行为日志表
        $this->initTable();
    }

    /**
     * 初始化行为日志表
     * @return string
     * @throws \think\db\exception\BindParamException
     * @throws \think\exception\PDOException
     * @author 牧羊人
     * @date 2019/4/4
     */
    public function initTable()
    {
        $tbl = $this->table;
        if (!$this->tableExists($this->table)) {
            $sql = "CREATE TABLE `{$tbl}` (
				`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
				`admin_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
				`username` varchar(20) NOT NULL DEFAULT '' COMMENT '管理员用户名',
				`operate_module` varchar(40) NOT NULL COMMENT '操作模块',
				`operate_controller` varchar(40) NOT NULL COMMENT '操作控制器',
				`operate_action` varchar(150) NOT NULL COMMENT '操作方法',
				`operate_param` text COMMENT '操作参数',
				`url` varchar(100) NOT NULL DEFAULT '' COMMENT '操作页面',
				`title` varchar(100) NOT NULL DEFAULT '' COMMENT '日志标题',
				`content` text NOT NULL DEFAULT '' COMMENT '内容',
				`ip` varchar(50) NOT NULL DEFAULT '' COMMENT 'IP',
				`useragent` varchar(255) NOT NULL DEFAULT '' COMMENT 'User-Agent',
				`sessionid` varchar(100) NOT NULL DEFAULT '' COMMENT 'sessionID',
				`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
				PRIMARY KEY (`id`),
				KEY `username` (`username`)
				) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员日志表';";
            $this->query($sql);
        }

        return $tbl;
    }

    /**
     * 设置标题
     * @param string $title 标题
     * @author 牧羊人
     * @date 2019/4/4
     */
    public static function setTitle($title)
    {
        self::$title = $title;
    }

    /**
     * 设置内容
     * @param string $content 内容
     * @author 牧羊人
     * @date 2019/4/4
     */
    public static function setContent($content)
    {
        self::$content = $content;
    }

    /**
     * 记录行为日志
     * @author 牧羊人
     * @date 2019/4/4
     */
    public static function record()
    {
//        $aid = get_uid();
//        $username = model('admin')->where('id', $aid)->value('username');
//        $module = request()->module();
//        $action = request()->url();
//        $param = request()->param() ? json_encode(request()->param()) : '';
//        $title = self::$title;
//        $content = self::$content;
//        self::create([
//            'admin_id' => $aid,
//            'username' => $username,
//            'module' => $module,
//            'action' => $action,
//            'param' => $param,
//            'title' => $title,
//            'content' => $content,
//            'ip' => request()->ip(1),
//            'user_agent' => request()->server('HTTP_USER_AGENT')
//        ]);
    }
}
