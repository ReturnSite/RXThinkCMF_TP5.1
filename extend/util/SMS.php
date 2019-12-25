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

namespace util;

/**
 * 短信发送类
 *
 * @author 牧羊人
 * @date 2018-08-30
 */
class SMS
{
    /**
     * 发送短信
     * @param $mobile 手机号
     * @param $content 短信内容
     * @param $groupId
     * @param $sign
     * @param $errMsg 错误信息
     * @return mixed
     * @author 牧羊人
     * @date 2019/10/24
     */
    public static function sendSms($mobile, $content, $groupId, $sign, &$errMsg)
    {
        $config = SMS::getServicerConfig($groupId);
        $ch = curl_init();
        $data = (array)$config['params'];
        foreach ($data as $name => &$row) {
            if (is_string($row) && strpos($row, "}")) {
                $row = str_replace("{MOBILE}", $mobile, $row);
                $row = str_replace("{CONTENT}", $content, $row);
                $row = str_replace("{SIGN}", $sign, $row);
            }
        }
        $data = http_build_query($data, null, "&");
        unset($row);
        curl_setopt($ch, CURLOPT_URL, $config['api_url']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        //echo "\nresponse start";
        //var_dump($response);
        //echo "\nresponse end";
        return $config['result']($response, $errMsg);
    }

    /**
     * 根据分组获取短信平台账号
     * @param $groupId
     * @return mixed
     * @author 牧羊人
     * @date 2019/10/24
     */
    static function getServicerConfig($groupId)
    {
        return config("sms.SMS_{$groupId}");
    }
}
