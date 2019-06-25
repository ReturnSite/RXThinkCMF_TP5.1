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

use util\QrcodeService;

class Test extends AdminBase
{
    public function initialize()
    {
        parent::initialize();
        $this->model = new \app\admin\model\Admin();
    }

    public function index()
    {
        return $this->fetch("test_index");
    }

    public function createQrcode()
    {
        // 自定义二维码配置
        $config = [
            'title' => true,
            'title_content' => 'RXThinkCMF官方网站',
            'logo' => true,
            'logo_url' => UPLOAD_TEMP_PATH . '/logo_mini.png',
            'logo_size' => 80,
            'file_name' => UPLOAD_TEMP_PATH,
        ];

        // 直接输出
        $qr_url = 'http://www.baidu.com?id=' . rand(1000, 9999);

        // 标识生成文件
//         $config['generate']  = true;
        $qr_code = new QrcodeService($config);
        $qr_img = $qr_code->create_qrcode($qr_url);
//         print_r($qr_img);exit;
        echo $qr_img;
        exit;
    }

    public function index2()
    {
        return $this->fetch();
    }

    public function test()
    {
        $result = "{\"0\":{\"id\":82,\"name\":\"南京云恒信息技术有限公司\",\"isParent\":true,\"icon\":\"http://static.rxthink.com/admin/images/1_open.png\",\"open\":true,\"children\":[{\"id\":105,\"name\":\"总经办\",\"isParent\":true,\"icon\":\"http://static.rxthink.com/admin/images/1_open.png\",\"url\":\"http://admin.rxthink.com/test/index\"},{\"id\":116,\"name\":\"人事行政部\",\"isParent\":true,\"icon\":\"http://static.rxthink.com/admin/images/1_open.png\"},{\"id\":106,\"name\":\"运营中心\",\"isParent\":true,\"icon\":\"http://static.rxthink.com/admin/images/1_open.png\"},{\"id\":107,\"name\":\"技术中心\",\"isParent\":true,\"icon\":\"http://static.rxthink.com/admin/images/1_open.png\"},{\"id\":133,\"name\":\"生产中心\",\"isParent\":true,\"icon\":\"http://static.rxthink.com/admin/images/1_open.png\"},{\"id\":134,\"name\":\"销售部\",\"isParent\":true,\"icon\":\"http://static.rxthink.com/admin/images/1_open.png\"}]}}";
        return json_decode($result, true);
    }

    public function tree()
    {
        return $this->fetch();
    }

    public function main()
    {
        $this->assign('left_name', 'main_left');
        $this->assign('left_url', '/ajax/getCateList');
        $this->assign('right_url', '/test/index');
        return $this->fetch("public/main");
    }
}
