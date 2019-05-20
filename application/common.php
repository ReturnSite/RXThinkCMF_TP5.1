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

use think\facade\Env;
use think\Request;

// 应用公共文件

/**
 * 加载自定义公共配置文件
 * 
 * @author 牧羊人
 * @date 2019-04-04
 */
if (is_file(Env::get('app_path') . 'function.php')) {
    include_once Env::get('app_path') . 'function.php';
}

if (!function_exists('__')) {

    /**
     * 获取语言变量值
     * @param string $name 语言变量名
     * @param array $vars 动态变量值
     * @param string $lang 语言
     * @return mixed
     */
    function __($name, $vars = [], $lang = '')
    {
        if (is_numeric($name) || !$name)
            return $name;
        if (!is_array($vars)) {
            $vars = func_get_args();
            array_shift($vars);
            $lang = '';
        }
        return \think\Lang::get($name, $vars, $lang);
    }

}

if (!function_exists('array2xml')) {

    /**
     * 数组转XML
     * @param array $arr 待转换的数组
     * @param bool $ignore XML解析器忽略
     * @param intval $level 层级
     * @return type
     */
    function array2xml($arr, $ignore = true, $level = 1)
    {
        $s = $level == 1 ? "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\r\n<root>\r\n" : '';
        $space = str_repeat("\t", $level);
        foreach($arr as $k => $v) {
            if(!is_array($v)) {
                $s .= $space."<item id=\"$k\">".($ignore ? '<![CDATA[' : '').$v.($ignore ? ']]>' : '')."</item>\r\n";
            } else {
                $s .= $space."<item id=\"$k\">\r\n".array2xml($v, $ignore, $level + 1).$space."</item>\r\n";
            }
        }
        $s = preg_replace("/([\x01-\x08\x0b-\x0c\x0e-\x1f])+/", ' ', $s);
        return $level == 1 ? $s."</root>" : $s;
    }

}

if(!function_exists('array_sort')) {

    /**
     * 二位数组排序
     * @param unknown $arr
     * @param unknown $keys
     * @param string $desc
     */
    function array_sort($arr, $keys, $desc = false)
    {
        $key_value = $new_array = array();
        foreach ($arr as $k => $v) {
            $key_value[$k] = $v[$keys];
        }
        if ($desc) {
            arsort($key_value);
        } else {
            asort($key_value);
        }
        reset($key_value);
        foreach ($key_value as $k => $v) {
            $new_array[$k] = $arr[$k];
        }
        return $new_array;
    }
}

if(!function_exists('array_merge_multiple')) {

    /**
     * 多维数组合并
     * @param unknown $array1
     * @param unknown $array2
     */
    function array_merge_multiple($array1, $array2)
    {
        $merge = $array1 + $array2;
        $data = [];
        foreach ($merge as $key => $val) {
            if (
                isset($array1[$key])
                && is_array($array1[$key])
                && isset($array2[$key])
                && is_array($array2[$key])
            ) {
                $data[$key] = array_merge_multiple($array1[$key], $array2[$key]);
            } else {
                $data[$key] = isset($array2[$key]) ? $array2[$key] : $array1[$key];
            }
        }
        return $data;
    }
}

if(!function_exists('base_url')) {

    /**
     * 获取当前域名及根路径
     */
    function base_url()
    {
        static $baseUrl = '';
        if (empty($baseUrl)) {
            $request = Request::instance();
            $subDir = str_replace('\\', '/', dirname($request->server('PHP_SELF')));
            $baseUrl = $request->scheme() . '://' . $request->host() . $subDir . ($subDir === '/' ? '' : '/');
        }
        return $baseUrl;
    }

}

if (!function_exists('cur_url')) {

    /**
     * 获取当前访问的完整URL
     * @return string
     */
    function cur_url()
    {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on') {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

}

if(!function_exists('curl_get')) {

    /**
     * curl请求（GET）
     */
    function curl_get($url, $data = []) {
        // 处理get数据
        if (!empty($data)) {
            $url = $url . '?' . http_build_query($data);
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
}

if(!function_exists('curl_post')) {

    /**
     * curl请求（POST）
     * @param unknown $url
     * @param unknown $data
     */
    function curl_post($url, $data = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

if (!function_exists('datetime')) {

    /**
     * 将时间戳转换为日期时间
     * @param int $time 时间戳
     * @param string $format 日期时间格式
     * @return string
     */
    function datetime($time, $format = 'Y-m-d H:i:s')
    {
        $time = is_numeric($time) ? $time : strtotime($time);
        return date($format, $time);
    }

}

if(!function_exists('export_excel')) {

    /**
     * 数据导出Excel(csv文件)
     * @param unknown $fileName
     * @param unknown $tileArray
     * @param unknown $dataArray
     */
    function export_excel($fileName, $tileArray = [], $dataArray = [])
    {
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 0);
        ob_end_clean();
        ob_start();
        header("Content-Type: text/csv");
        header("Content-Disposition:filename=" . $fileName);
        $fp = fopen('php://output', 'w');
        fwrite($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));// 转码 防止乱码(比如微信昵称)
        fputcsv($fp, $tileArray);
        $index = 0;
        foreach ($dataArray as $item) {
            if ($index == 1000) {
                $index = 0;
                ob_flush();
                flush();
            }
            $index++;
            fputcsv($fp, $item);
        }
        ob_flush();
        flush();
        ob_end_clean();
    }
}

if (!function_exists('format_bytes')) {

    /**
     * 将字节转换为可读文本
     * @param int $size 大小
     * @param string $delimiter 分隔符
     * @return string
     */
    function format_bytes($size, $delimiter = '')
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 6; $i++)
            $size /= 1024;
        return round($size, 2) . $delimiter . $units[$i];
    }

}

if (!function_exists('get_domain')) {
    
    /**
     * 获取当前域名
     * @param bool $http true 返回http协议头,false 只返回域名
     * @return string
     */
    function get_domain($http = true) 
    {
        $host = input('server.http_host');
        if (input('server.server_port') != 80 && strpos($host, ':') === false) {
            $host .= ':'.input('server.server_port');
        }

        if ($http) {
            if (input('server.https') && input('server.https') == 'on') {
                return 'https://'.$host;
            }
            return 'http://'.$host;
        }

        return $host;
    }
    
}

if(!function_exists('get_guid_v4')) {

    /**
     * 获取GUID
     * @param string $trim
     * @return Ambigous <string, unknown>|string
     */
    function get_guid_v4($trim = true) {
        // Windows
        if (function_exists('com_create_guid') === true) {
            $charid = com_create_guid();
            return $trim == true ? trim($charid, '{}') : $charid;
        }
        // OSX/Linux
        if (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }
        // Fallback (PHP 4.2+)
        mt_srand((double)microtime() * 10000);
        $charid = strtolower(md5(uniqid(rand(), true)));
        $hyphen = chr(45);                  // "-"
        $lbrace = $trim ? "" : chr(123);    // "{"
        $rbrace = $trim ? "" : chr(125);    // "}"
        $guidv4 = $lbrace .
        substr($charid, 0, 8) . $hyphen .
        substr($charid, 8, 4) . $hyphen .
        substr($charid, 12, 4) . $hyphen .
        substr($charid, 16, 4) . $hyphen .
        substr($charid, 20, 12) .
        $rbrace;
        return $guidv4;
    }
}

if (!function_exists('get_client_ip')) {

    /**
     * 获取客户端IP地址
     * @param int $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @param bool $adv 是否进行高级模式获取（有可能被伪装）
     * @return mixed
     */
    function get_client_ip($type = 0, $adv = false) {
        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if($adv){
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos    =   array_search('unknown',$arr);
                if(false !== $pos) unset($arr[$pos]);
                $ip     =   trim($arr[0]);
            }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip     =   $_SERVER['HTTP_CLIENT_IP'];
            }elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip     =   $_SERVER['REMOTE_ADDR'];
            }
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }

}

if (!function_exists('get_order_num')) {

    /**
     * 生成订单号(年月日时分秒+5位随机数)
     * @return int
     */
    function get_order_num() {
        return date('YmdHis').random(5);
    }

}

if (!function_exists('hide_str')) {

    /**
     * 将一个字符串部分字符用*替代隐藏
     * @param string    $string   待转换的字符串
     * @param int       $bengin   起始位置，从0开始计数，当$type=4时，表示左侧保留长度
     * @param int       $len      需要转换成*的字符个数，当$type=4时，表示右侧保留长度
     * @param int       $type     转换类型：0，从左向右隐藏；1，从右向左隐藏；2，从指定字符位置分割前由右向左隐藏；3，从指定字符位置分割后由左向右隐藏；4，保留首末指定字符串中间用***代替
     * @param string    $glue     分割符
     * @return string   处理后的字符串
     */
    function hide_str($string, $bengin=0, $len = 4, $type = 0, $glue = "@")
    {
        if (empty($string))
            return false;
        $array = array();
        if ($type == 0 || $type == 1 || $type == 4) {
            $strlen = $length = mb_strlen($string);
            while ($strlen) {
                $array[] = mb_substr($string, 0, 1, "utf8");
                $string = mb_substr($string, 1, $strlen, "utf8");
                $strlen = mb_strlen($string);
            }
        }
        if ($type == 0) {
            for ($i = $bengin; $i < ($bengin + $len); $i++) {
                if (isset($array[$i])) $array[$i] = "*";
            }
            $string = implode("", $array);
        }else if ($type == 1) {
            $array = array_reverse($array);
            for ($i = $bengin; $i < ($bengin + $len); $i++) {
                if (isset($array[$i])) $array[$i] = "*";
            }
            $string = implode("", array_reverse($array));
        }else if ($type == 2) {
            $array = explode($glue, $string);
            if (isset($array[0])) {
                $array[0] = hide_str($array[0], $bengin, $len, 1);
            }
            $string = implode($glue, $array);
        } else if ($type == 3) {
            $array = explode($glue, $string);
            if (isset($array[1])) {
                $array[1] = hide_str($array[1], $bengin, $len, 0);
            }
            $string = implode($glue, $array);
        } else if ($type == 4) {
            $left = $bengin;
            $right = $len;
            $tem = array();
            for ($i = 0; $i < ($length - $right); $i++) {
                if (isset($array[$i])) $tem[] = $i >= $left ? "" : $array[$i];
            }
            $tem[] = '*****';
            $array = array_chunk(array_reverse($array), $right);
            $array = array_reverse($array[0]);
            for ($i = 0; $i < $right; $i++) {
                if (isset($array[$i])) $tem[] = $array[$i];
            }
            $string = implode("", $tem);
        }
        return $string;
    }

}

if (!function_exists('is_email')) {
    
    /**
     * 判断是否为邮箱
     * @param string $str 要验证的邮箱地址
     * @return bool
     */
    function is_email($str) 
    {
        return preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $str);
    }
    
}

if (!function_exists('is_mobile')) {
    
    /**
     * 判断是否为手机号
     * @param string $num 要验证的手机号
     * @return bool
     */
    function is_mobile($num) 
    {
        return preg_match('/^1(3|4|5|7|8)\d{9}$/', $num);
    }
    
}

if(!function_exists('is_zipcode')) {
    
    /**
     * 验证邮编是否正确
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param unknown $code 邮编
     * @return number
     */
    function is_zipcode($code)
    {
        return preg_match('/^[1-9][0-9]{5}$/', $code);
    }
    
}

if(!function_exists('is_idcard')) {
    
    /**
     * 验证身份证是否正确
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param unknown $idno
     * @return boolean
     */
    function is_idcard($idno)
    {
        $idno = strtoupper($idno);
        $regx = '/(^\d{15}$)|(^\d{17}([0-9]|X)$)/';
        $arr_split = array();
        if (!preg_match($regx, $idno)) {
            return FALSE;
        }
        //检查15位
        if (15==strlen($idno)) {
            $regx = '/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/';
            @preg_match($regx, $idno, $arr_split);
            $dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
            if (!strtotime($dtm_birth)) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            //检查18位
            $regx = '/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/';
            @preg_match($regx, $idno, $arr_split);
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
            //检查生日日期是否正确
            if (!strtotime($dtm_birth)) {
                return FALSE;
            } else {
                //检验18位身份证的校验码是否正确。
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                $sign = 0;
                for ($i=0; $i<17; $i++) {
                    $b = (int) $idno{$i};
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($idno,17, 1)) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        }
    }
    
}

if (!function_exists('is_empty')) {

    /**
     * 判断是否为空值
     * @param array|string $value 要判断的值
     * @return bool
     */
    function is_empty($value)
    {
        if (!isset($value)) {
            return true;
        }

        if ($value === null) {
            return true;
        }

        if (trim($value) === '') {
            return true;
        }

        return false;
    }

}

if (!function_exists('is_username')) {
    
    /**
     * 判断用户名
     * 用户名支持中文、字母、数字、下划线，但必须以中文或字母开头，长度3-20个字符
     * @param string $str 要验证的字符串
     * @return bool
     */
    function is_username($str) 
    {
        return preg_match("/^[\x80-\xffA-Za-z]{1,1}[\x80-\xff_A-Za-z0-9]{2,19}+$/", $str);
    }
    
}

if (!function_exists('json_indent')) {

    /**
     * JSON数据美化
     * @param string $json json字符串
     * @return string
     */
    function json_indent($json)
    {
        $result = '';
        $pos = 0;
        $strLen = strlen($json);
        $indentStr = '  ';
        $newLine = "\n";
        $prevChar = '';
        $outOfQuotes = true;
        for ($i=0; $i<=$strLen; $i++) {
            $char = substr($json, $i, 1);
            if ($char == '"' && $prevChar != '\\') {
                $outOfQuotes = !$outOfQuotes;
            } else if(($char == '}' || $char == ']') && $outOfQuotes) {
                $result .= $newLine;
                $pos --;
                for ($j=0; $j<$pos; $j++) {
                    $result .= $indentStr;
                }
            }
            $result .= $char;
            if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
                $result .= $newLine;
                if ($char == '{' || $char == '[') {
                    $pos ++;
                }
                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indentStr;
                }
            }
            $prevChar = $char;
        }
        return $result;
    }

}

if(!function_exists('message')) {

    /**
     * 消息对象函数
     */
    if(defined('IS_API')) {
        function message($msg = "系统繁忙，请稍候再试" , $success = false , $data = array(), $code=0){
            $msg =  array("success" => $success , "msg" => $msg , "data" => $data);
            if($msg['success']) {
                $msg['code'] = 10000;
            }else {
                $msg['code'] = $code ? $code : 90000;
            }
            return $msg;
        }
    }else{
        function message($msg = "操作成功" , $success = true , $data = array()){
            $msg =  array("success" => $success , "msg" => $msg , "data" => $data);
            return $msg;
        }
    }
}

if (!function_exists('parse_attr')) {

    /**
     * 配置值解析成数组
     * @param string $value 配置值
     * @return array|string
     */
    function parse_attr($value = '')
    {
        if (is_array($value)) return $value;
        $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
        if (strpos($value, ':')) {
            $value  = array();
            foreach ($array as $val) {
                list($k, $v) = explode(':', $val);
                $value[$k]   = $v;
            }
        } else {
            $value = $array;
        }
        return $value;
    }

}

if (!function_exists('random')) {
    
    /**
     * 随机字符串
     * @param int $length 长度
     * @param int $type 类型(0：混合；1：纯数字)
     * @return string
     */
    function random($length = 16, $type = 1) {
        $seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $type ? 10 : 35);
        $seed = $type ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
        if($type) {
            $hash = '';
        } else {
            $hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
            $length--;
        }
        $max = strlen($seed) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $seed{mt_rand(0, $max)};
        }
        return $hash;
    }
    
}

if (!function_exists('xml2array')) {

    /**
     * XML转数组
     * @param string $xml xml格式内容
     * @param bool $isnormal
     * @return array
     */
    function xml2array(&$xml, $isnormal = FALSE)
    {
        $xml = "<xml>";
        foreach ($xml as $key=>$val)
        {
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                 $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

}

if(!function_exists('is_login')) {
    
    /**
     * 判断是否登录
     * 
     * @author 牧羊人
     * @date 2019-04-04
     */
    function is_login()
    {
        
    }
}

if(!function_exists('runhook')) {
    
    /**
     * 监听钩子
     * @param string $name 钩子名称
     * @param string $params 传入参数
     * @param string $once 只获取一个有效返回值
     */
    function runhook($name = '', $params = null, $once = false)
    {
        \think\facade\Hook::listen($name, $params, $once);
    }
    
}

if(!function_exists('get_plugin_class')) {
    
    /**
     * 获取插件类名
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param unknown $name 插件类名
     */
    function get_plugin_class($name)
    {
        return "plugins\\{$name}\\{$name}";
    }
    
}

if(!function_exists('format_time')) {
    
    /**
     * 格式化时间
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param string $time 时间戳
     * @param string $format 输出格式
     * @return string
     */
    function format_time($time = null, $format = 'Y-m-d H:i')
    {
        return !$time ? '' : date($format, intval($time));
    }
    
}

if(!function_exists('format_date')) {
    
    /**
     * 格式化日期
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param string $time 时间戳
     * @param string $format 输出格式
     * @return string
     */
    function format_date($time = null, $format = 'yyyy-mm-dd')
    {
        $format_map = [
            'yyyy' => 'Y',
            'yy'   => 'y',
            'MM'   => 'F',
            'M'    => 'M',
            'mm'   => 'm',
            'm'    => 'n',
            'DD'   => 'l',
            'D'    => 'D',
            'dd'   => 'd',
            'd'    => 'j',
        ];
        
        // 提取格式
        preg_match_all('/([a-zA-Z]+)/', $format, $matches);
        $replace = [];
        foreach ($matches[1] as $match) {
            $replace[] = isset($format_map[$match]) ? $format_map[$match] : '';
        }
        
        // 替换成date函数支持的格式
        $format = str_replace($matches[1], $replace, $format);
        $time = $time === null ? time() : intval($time);
        return date($format, $time);
    }
    
}

if(!function_exists('format_datetime')) {
    
    /**
     * 格式化时间戳为日期时间
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param unknown $time 时间戳
     * @param string $format 输出格式
     * @return string
     */
    function format_datetime($time, $format = 'Y-m-d H:i:s')
    {
        if (empty($time)) return '--';
        $time = is_numeric($time) ? $time : strtotime($time);
        return date($format, $time);
    }
    
}

if(!function_exists('plugin_action_exists')) {
    
    /**
     * 检查插件控制器是否存在某操作
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param string $name 插件名
     * @param string $controller 控制器
     * @param string $action 操作方法
     */
    function plugin_action_exists($name = '', $controller = '', $action = '')
    {
        if (strpos($name, '/')) {
            list($name, $controller, $action) = explode('/', $name);
        }
        return method_exists("plugins\\{$name}\\controller\\{$controller}", $action);
    }
    
}

if(!function_exists('plugin_model_exists')) {
    
    /**
     * 检查插件模型是否存在
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param string $name 插件名
     * @return boolean
     */
    function plugin_model_exists($name = '')
    {
        return class_exists("plugins\\{$name}\\model\\{$name}");
    }
    
}

if(!function_exists('plugin_validate_exists')) {
    
    /**
     * 检查插件验证器是否存在
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param string $name 插件名
     * @return boolean
     */
    function plugin_validate_exists($name = '')
    {
        return class_exists("plugins\\{$name}\\validate\\{$name}");
    }
    
}

if(!function_exists('get_plugin_model')) {
    
    /**
     * 获取插件模型实例
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param unknown $name 插件名
     * @return unknown
     */
    function get_plugin_model($name)
    {
        $class = "plugins\\{$name}\\model\\{$name}";
        return new $class;
    }
    
}

if(!function_exists('plugin_run')) {
    
    /**
     * 执行插件动作
     * 也可以用这种方式调用：plugin_run('插件名/控制器/动作', [参数1,参数2...])
     * @author 牧羊人
     * @date 2019-04-04
     * @param string $name 插件名
     * @param string $controller 控制器
     * @param string $action 工作
     * @param unknown $params 参数
     */
    function plugin_run($name = '', $controller = '', $action = '', $params = [])
    {
        if (strpos($name, '/')) {
            $params = is_array($controller) ? $controller : (array)$controller;
            list($name, $controller, $action) = explode('/', $name);
        }
        if (!is_array($params)) {
            $params = (array)$params;
        }
        $class = "plugins\\{$name}\\controller\\{$controller}";
        $obj = new $class;
        return call_user_func_array([$obj, $action], $params);
    }
    
}

if(!function_exists('get_plugin_validate')) {
    
    /**
     * 获取插件验证类实例
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param string $name 插件名
     * @return unknown
     */
    function get_plugin_validate($name = '')
    {
        $class = "plugins\\{$name}\\validate\\{$name}";
        return new $class;
    }
    
}

if(!function_exists('plugin_url')) {
    
    /**
     * 生成插件操作链接
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param string $url 链接：插件名称/控制器/操作
     * @param unknown $param 参数
     * @param string $module 模块名，admin需要登录验证，index不需要登录验证
     * @return string
     */
    function plugin_url($url = '', $param = [], $module = 'admin')
    {
        $params = [];
        $url = explode('/', $url);
        if (isset($url[0])) {
            $params['_plugin'] = $url[0];
        }
        if (isset($url[1])) {
            $params['_controller'] = $url[1];
        }
        if (isset($url[2])) {
            $params['_action'] = $url[2];
        }
        
        // 合并参数
        $params = array_merge($params, $param);
        
        // 返回url地址
        return url($module .'/plugin/execute', $params);
    }
    
}

if(!function_exists('get_server_ip')) {
    
    /**
     * 获取服务端IP地址
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @return string
     */
    function get_server_ip()
    {
        if(isset($_SERVER)){
            if($_SERVER['SERVER_ADDR']){
                $server_ip = $_SERVER['SERVER_ADDR'];
            }else{
                $server_ip = $_SERVER['LOCAL_ADDR'];
            }
        }else{
            $server_ip = getenv('SERVER_ADDR');
        }
        return $server_ip;
    }
    
}

if(!function_exists('get_random_str')) {
    
    /**
     * 生成随机字符串
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param number $length 生成长度
     * @param number $type $type 生成类型：0-小写字母+数字，1-小写字母，2-大写字母，3-数字，4-小写+大写字母，5-小写+大写+数字
     * @return string
     */
    function get_random_str($length = 8, $type = 0)
    {
        $a = 'abcdefghijklmnopqrstuvwxyz';
        $A = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $n = '0123456789';
        
        switch ($type) {
            case 1: $chars = $a; break;
            case 2: $chars = $A; break;
            case 3: $chars = $n; break;
            case 4: $chars = $a.$A; break;
            case 5: $chars = $a.$A.$n; break;
            default: $chars = $a.$n;
        }
        
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        return $str;
    }
    
}

if(!function_exists('format_money_yuan')) {
    
    /**
     * 以分为单位的金额转换成元
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param unknown $money
     * @return string
     */
    function format_money_yuan($money = 0)
    {
        if ($money>0) {
            return number_format($money/100, 2, ".", "");
            //return sprintf("%.2f", $money);
        }
        return "0.00";
    }
    
}

if(!function_exists('format_money_cent')) {
    
    /**
     * 以元为单位的金额转化成分
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param unknown $money
     * @return string
     */
    function format_money_cent($money)
    {
        return (string)($money*100);
    }
    
}

if(!function_exists('format_bank_card_no')) {
    
    /**
     * 银行卡格式转换
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param unknown $card_no 银行卡号
     * @param string $is_cover 
     * @return string
     */
    function format_bank_card_no($card_no, $is_cover = true)
    {
        if($is_cover){
            //截取银行卡号前4位
            $prefix = substr($card_no,0,4);
            //截取银行卡号后4位
            $suffix = substr($card_no,-4,4);
             
            $format_card_no = $prefix." **** **** **** ".$suffix;
        }else{
            $arr = str_split($card_no,4);//4的意思就是每4个为一组
            $format_card_no = implode(' ',$arr);
        }
        return $format_card_no;
    }
    
}

if(!function_exists('strip_html_tags')) {
    
    /**
     * 去除HTML标签、图像等 仅保留文本
     * 
     * @author 模样热
     * @date 2019-04-04
     * @param unknown $str 字符串
     * @param number $length 指定截取长度（默认全返回）
     */
    function strip_html_tags($str, $length = 0)
    {
        $str = htmlspecialchars_decode($str);//把一些预定义的 HTML 实体转换为字符
        $str = str_replace("&nbsp;","",$str);//将空格替换成空
        $str = strip_tags($str);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
        $str = str_replace(array("\n", "\r\n", "\r"), ' ', $str);
        $preg = '/<script[\s\S]*?<\/script>/i';
        $str = preg_replace($preg,"",$str,-1);//剥离JS代码
        if($length==2) {
            //返回字符串中的前100字符串长度的字符
            $str = mb_substr($str, 0, $length,"utf-8");
        }
        return $str;
    }
    
}

if(!function_exists('strip_html_tags2')) {
    
    /**
     * 去除指定HTML标签
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param unknown $tags 指定的标签
     * @param unknown $str 字符串
     * @param number $content 是否删除标签内的内容 0保留内容 1不保留内容
     * 
     * 示例：echo strip_html_tags(array('a','img'),$str)
     */
    function strip_html_tags2($tags, $str, $content = 0)
    {
        if($content){
            $html = array();
            foreach ($tags as $tag) {
                $html[] = '/(<'.$tag.'.*?>[\s|\S]*?<\/'.$tag.'>)/';
            }
            $result = preg_replace($html,'',$str);
        }else{
            $html = array();
            foreach ($tags as $tag) {
                $html[] = "/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";
            }
            $result = preg_replace($html, '', $str);
        }
        return $result;
    }
    
}

if(!function_exists('sub_str')) {
    
    /**
     * 字符串截取
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param unknown $str 需要截取的字符串
     * @param number $start 开始位置
     * @param unknown $length 截取长度
     * @param string $suffix 截断显示字符
     * @param string $charset 编码格式
     * @return string
     */
    function sub_str($str, $start = 0, $length, $suffix=true, $charset="utf-8")
    {
        if(function_exists("mb_substr"))
            $slice = mb_substr($str, $start, $length, $charset);
        elseif(function_exists('iconv_substr')) {
            $slice = iconv_substr($str,$start,$length,$charset);
        }else{
            $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk']  = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("",array_slice($match[0], $start, $length));
        }
        $omit = mb_strlen($str) >=$length ? '...' : '';
        return $suffix ? $slice.$omit : $slice;
    }
    
}

if(!function_exists('get_zodiac_sign')) {
    
    
    /**
     * 根据月、日获取星座
     * 
     * @author 模样人
     * @date 2019-04-04
     * @param unknown $month 月
     * @param unknown $day 日
     * @return boolean|multitype:
     */
    function get_zodiac_sign($month, $day)
    {
        // 检查参数有效性
        if ($month < 1 || $month > 12 || $day < 1 || $day > 31) {
            return false;
        }
            
        // 星座名称以及开始日期
        $signs = array(
            array( "20" => "水瓶座"),
            array( "19" => "双鱼座"),
            array( "21" => "白羊座"),
            array( "20" => "金牛座"),
            array( "21" => "双子座"),
            array( "22" => "巨蟹座"),
            array( "23" => "狮子座"),
            array( "23" => "处女座"),
            array( "23" => "天秤座"),
            array( "24" => "天蝎座"),
            array( "22" => "射手座"),
            array( "22" => "摩羯座")
        );
        list($sign_start, $sign_name) = each($signs[(int)$month-1]);
        if ($day < $sign_start) {
            list($sign_start, $sign_name) = each($signs[($month -2 < 0) ? $month = 11: $month -= 2]);
        }
        return $sign_name;        
    }
    
}

if(!function_exists('get_format_time')) {
    
    /**
     * 获取格式化显示时间
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @param unknown $time 传入时间
     * @return string 格式化结果
     */
    function get_format_time($time)
    {
        $time = (int) substr($time, 0, 10);
        $int = time() - $time;
        $str = '';
        if ($int <= 2){
            $str = sprintf('刚刚', $int);
        }elseif ($int < 60){
            $str = sprintf('%d秒前', $int);
        }elseif ($int < 3600){
            $str = sprintf('%d分钟前', floor($int / 60));
        }elseif ($int < 86400){
            $str = sprintf('%d小时前', floor($int / 3600));
        }elseif ($int < 1728000){
            $str = sprintf('%d天前', floor($int / 86400));
        }else{
            $str = date('Y-m-d H:i:s', $time);
        }
        return $str;
    }
    
}

if(!function_exists('get_device_type')) {
    
    /**
     * 获取设备类型
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @return number 0：其他  1：iOS  2：Android
     */
    function get_device_type()
    {
        //全部变成小写字母
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $type = 0;
        //分别进行判断
        if(strpos($agent, 'iphone')!==false || strpos($agent, 'ipad')!==false){
            $type = 1;
        }
        if(strpos($agent, 'android')!==false){
            $type = 2;
        }
        return $type;
    }
    
}

if(!function_exists('is_mobile_visit')) {
    
    /**
     * 检测是否手机访问
     * 
     * @author 牧羊人
     * @date 2019-04-04
     * @return boolean
     */
    function is_mobile_visit()
    {
        $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
        function _is_mobile($substrs,$text){
            foreach($substrs as $substr)
                if(false!==strpos($text,$substr)){
                return true;
            }
            return false;
        }
        $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
        $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');
        
        $found_mobile=_is_mobile($mobile_os_list,$useragent_commentsblock) ||
        _is_mobile($mobile_token_list,$useragent);
        if ($found_mobile){
            return true;
        }else{
            return false;
        }
    }
    
}

if (!function_exists('get_password')) {
    
    /**
     * 获取双MD5加密密码
     * 
     * @author 牧羊人
     * @date 2019-04-21
     * @param unknown $password 加密字符串
     * @return string MD5加密字符串输出
     */
    function get_password($password)
    {
        return md5(md5($password));
    }
    
}

if (!function_exists('get_image_url')) {
    
    /**
     * 获取网络图片地址
     * 
     * @author 牧羊人
     * @date 2019-04-21
     * @param unknown $image_url 图片地址
     * @return string 输出网络图片地址
     */
    function get_image_url($image_url)
    {
        return IMG_URL . $image_url;
    }
    
}

if (!function_exists('encrypt')) {
    /**
     * DES加密
     * 
     * @author 模样人
     * @date 2019-04-27
     * @param unknown $str 加密数据
     * @param unknown $key 加密KEY
     * @return string 加密后字符串
     */
    function encrypt($str, $key)
    {
        $prep_code = serialize($data);
        $block = mcrypt_get_block_size('des', 'ecb');
        if (($pad = $block - (strlen($prep_code) % $block)) < $block) {
            $prep_code .= str_repeat(chr($pad), $pad);
        }
        $encrypt = mcrypt_encrypt(MCRYPT_DES, $key, $prep_code, MCRYPT_MODE_ECB);
        return base64_encode($encrypt);
        
    }
}

if (!function_exists('decrypt')) {
    
    /**
     * DES解密
     * 
     * @author 牧羊人
     * @date 2019-04-07
     * @param unknown $str 解密字符串
     * @param unknown $key 解密KEY
     * @return mixed
     */
    function decrypt($str, $key)
    {
        $str = base64_decode($str);
        $str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);
        $block = mcrypt_get_block_size('des', 'ecb');
        $pad = ord($str[($len = strlen($str)) - 1]);
        if ($pad && $pad < $block && preg_match('/' . chr($pad) . '{' . $pad . '}$/', $str)) {
            $str = substr($str, 0, strlen($str) - $pad);
        }
        return unserialize($str);
        
    }
}

if (!function_exists('get_hash')) {
    
    /**
     * 获取HASH值
     * 
     * @author 牧羊人
     * @date 2019-04-27
     * @return string 字符串hash值输出
     */
    function get_hash()
    {
        $chars   = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()+-';
        $random  = $chars[mt_rand(0,73)] . $chars[mt_rand(0,73)] . $chars[mt_rand(0,73)] . $chars[mt_rand(0,73)] . $chars[mt_rand(0,73)];
        $content = uniqid() . $random;
        return sha1($content);
        
    }
}

if (!function_exists('mkdirs')) {
    
    /**
     * 递归创建目录
     * 
     * @author 牧羊人
     * @date 2019-04-27
     * @param unknown $dir 需要创新的目录
     * @param number $mode 权限值
     * @return boolean
     */
    function mkdirs($dir, $mode = 0777)
    {
        if(is_dir($dir) || mkdir($dir,$mode,true)) return true;
        if(!mkdirs(dirname($dir),$mode)) return false;
        return mkdir($dir,$mode,true);
        
    }
}

if (!function_exists('format_mobile')) {
    
    /**
     * 格式化手机号码
     * 
     * @author 牧羊人
     * @date 2019-04-27
     * @param unknown $mobile
     */
    function format_mobile($mobile)
    {
        return substr($mobile,0,5)."****".substr($mobile,9,2);
    }
}

if (!function_exists('save_image')) {
    
    /**
     * 保存图片
     * 
     * @author 牧羊人
     * @date 2019-04-28
     * @param unknown $img_url 网络图片地址
     * @param string $save_dir 图片保存目录
     * @return boolean|mixed|unknown
     */
    function save_image($img_url, $save_dir = '/')
    {
        if(!$img_url) {
            return false;
        }
        $save_dir = trim($save_dir, "/");
        $imgExt = pathinfo($img_url, PATHINFO_EXTENSION);
        // 是否是本站图片
        if (strpos($img_url, IMG_URL)!==false) {
            // 是否是临时文件
            if (strpos($img_url, 'temp') === false) {
                return str_replace(IMG_URL, "", $img_url);
            }
            $new_path = create_image_path($save_dir, $imgExt);
            $old_path = str_replace(IMG_URL, IMG_PATH , $img_url);
            if (!file_exists($old_path)) {
                return false;
            }
            rename($old_path, IMG_PATH . $new_path);
            return $new_path;
        }else{
            // 保存远程图片
            $new_path = save_remote_image($img_url, $save_dir);
        }
        return $new_path;
    }
}

if (!function_exists('create_image_path')) {
    
    /**
     * 创建图片存储目录
     * 
     * @author 牧羊人
     * @date 2019-04-28
     * @param string $save_dir 存储目录
     * @param string $image_ext 图片后缀
     * @param string $image_root 图片存储根目录路径
     * @return string 返回文件目录
     */
    function create_image_path($save_dir = "", $image_ext = "", $image_root = IMG_PATH)
    {
        $image_dir = date("/Ymd/");
        if($image_dir) {
            $image_dir = ($save_dir ? "/" : '') . $save_dir . $image_dir;
        }
        // 未指定后缀默认使用JPG
        if(!$image_ext) {
            $image_ext = "jpg";
        }
        $image_path = $image_root . $image_dir;
        if(!is_dir($image_path)) {
            // 创建目录并赋予权限
            mkdir($image_path, 0777, true);
        }
        $file_name = substr(md5(time().rand(0,999999)),8, 16).rand(100,999).".{$image_ext}";
        $file_path = $image_dir . "/" . $file_name;
        return $file_path;
    }
}

if (!function_exists('save_remote_image')) {
    
    /**
     * 保存网络图片到本地
     * 
     * @author 牧羊人
     * @date 2019-04-28
     * @param unknown $img_url 网路图片地址
     * @param string $save_dir 存储目录
     * @return boolean|Ambigous <boolean, unknown>
     */
    function save_remote_image($img_url, $save_dir = '/')
    {
        $content = file_get_contents($img_url);
        if(!$content) {
            return false;
        }
        if($content{0} . $content{1} == "\xff\xd8") {
            $image_ext = 'jpg';
        }else if ($content{0} . $content{1} . $content{2} == "\x47\x49\x46") {
            $image_ext = 'gif';
        }else if ($content{0} . $content{1} . $content{2} == "\x89\x50\x4e") {
            $image_ext = 'png';
        }else{
            // 不是有效图片
            return false;
        }
        $save_path = create_image_path($save_dir, $image_ext);
        return file_put_contents(IMG_PATH . $save_path, $content) ? $save_path : false;
    }
}

if (!function_exists('save_image_content')) {
    
    /**
     * 富文本信息处理
     * 
     * @author 牧羊人
     * @date 2019-05-08
     * @param unknown $content 富文本内容
     * @param string $title 标题
     * @param string $path 图片存储路径
     * @return boolean|number
     */
    function save_image_content(&$content, $title = false, $path = 'article')
    {
        preg_match_all("/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?>/i", str_ireplace("\\","", $content), $match);
        if(!$match[1]) {
            return false;
        }
        $i=0;
        foreach ($match[1] as $id => $val) {
            $save_image = save_image($val, $path);
            if($save_image) {
                $content = str_replace($val, "[IMG_URL]" . $save_image, $content);
                $i++;
            }
        }
        if( (strpos($content, 'alt=\"\"') !== false) && $title ) {
            $content = str_replace('alt=\"\"', 'alt=\"' . $title . '\"', $content);
        }
        return $i;
    }
}
