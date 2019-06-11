<?php

namespace app\admin\controller;


use util\QrcodeService;

class Test extends AdminBase
{
    function initialize()
    {
        parent::initialize();
        $this->model = new \app\admin\model\Admin();
    }

    function index()
    {
        return $this->fetch();
    }

    function create_qrcode()
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
}
