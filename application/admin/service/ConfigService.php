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

namespace app\admin\service;

use app\admin\model\Config as ConfigModel;

/**
 * 配置-服务类
 * @author 牧羊人
 * @date 2019/4/24
 * Class ConfigService
 * @package app\admin\service
 */
class ConfigService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/4/24
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ConfigModel();
    }

    /**
     * 获取数据列表
     * @return array
     * @author 牧羊人
     * @date 2019/4/24
     */
    public function getList()
    {
        $param = request()->param();

        // 查询条件
        $map = [];

        // 配置分组ID
        $group_id = (int)$param['group_id'];
        if ($group_id) {
            $map[] = ['group_id', '=', $group_id];
        }

        return parent::getList($map);
    }

    /**
     * 分组信息编辑
     * @return BaseService|void
     * @author 牧羊人
     * @date 2019/4/24
     */
    public function group()
    {
        $data = request()->param();
        if (empty($data)) {
            return message("数据不能为空", false);
        }
        foreach ($data as $key => $val) {
            if (strpos($key, 'checkbox')) {
                $item = explode('__', $key);
                $key = $item[0];
                $val = implode(',', array_keys($val));
            } elseif (strpos($key, 'upimage')) {
                $item = explode('__', $key);
                $key = $item[0];
                if (strpos($val, "temp")) {
                    //新上传图片
                    $val = save_image($val, 'config');
                }
            } elseif (strpos($key, 'upimgs')) {
                $item = explode('__', $key);
                $key = $item[0];

                $imgArr = explode(',', $val);
                $imgStr = [];
                foreach ($imgArr as $kt => $vt) {
                    if (strpos($vt, "temp")) {
                        //新上传图片
                        $imgStr[] = save_image($vt, 'config');
                    } else {
                        //过滤已上传图片
                        $imgStr[] = str_replace(IMG_URL, "", $vt);
                    }
                }
                $val = serialize($imgStr);
            } elseif (strpos($key, 'ueditor')) {
                $item = explode('__', $key);
                $key = $item[0];
                //内容处理
                save_image_content($val, '', "config");
            }
            $info = $this->model->getInfoByAttr([
                ['name', '=', $key],
            ]);
            if (!$info) {
                continue;
            }
            $this->model->edit([
                'id' => $info['id'],
                'value' => $val,
            ]);
        }
        return message();
    }
}
