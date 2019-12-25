<?php


namespace util;


class HttpRequest
{
    /**
     * 获取网络请求数据
     * @author 牧羊人
     * @date 2019/11/4
     */
    public static function getRequestInfo()
    {
        if (isset($_REQUEST['APIDATA'])) {
            $dataStr = $_REQUEST['APIDATA'];
            $dataStr = str_replace(" ", "+", $dataStr);
            $data = decrypt(stripslashes($dataStr));
            $data = json_decode($data, true);
            //初始化表单数据
            foreach ($data as $key => $val) {
                if (IS_POST) {
                    $_POST[$key] = $val;
                } else {
                    $_GET[$key] = $val;
                }
                $_REQUEST[$key] = $val;
                $item[$key] = $val;
            }
            return $data;
        }
        return [];
    }
}