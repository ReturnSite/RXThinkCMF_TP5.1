<?php

namespace util;

/**
 * 官方授权处理执行类
 * 
 * @author 牧羊人
 * @date 2019-04-23
 * @author home
 *
 */
class Accredit 
{
    
    // 请求地址
    const EACOO_ACCREDIT_URL = 'http://www.eacoophp.com/client_product_accredit';
    
    /**
     * 授权执行
     * 
     * @author 牧羊人
     * @date 2019-04-23
     */
    public static function runAccredit($data = [])
    {
        $data = array_merge([
            'product_name'   => 'eacoophp',
            'product_verion' => '2.0',
            'build_verion'   => '201901010001',//编译版本
            'domain'         => request()->domain(),
        ], $data);
        
        $data['agent'] = $_SERVER['HTTP_USER_AGENT'];
        $result        = curl_post(self::EACOO_ACCREDIT_URL,$data);
        $result        = json_decode($result,true);
        $install_lock  = $result['data'];
        
        // 生成安装文件锁
        file_put_contents(ROOT_PATH . 'install.lock', json_encode($install_lock));
        return $install_lock;
    }
    
    /**
     * 获取产品授权token
     * 
     * @author 牧羊人
     * @date 2019-04-23
     */
    function getAccreditToken()
    {
        $token = Cache::get('accredit_token');
        if (!$token) {
            $install_lock = json_decode(file_get_contents(ROOT_PATH . 'install.lock'),true);
            if ($install_lock) {
                $token = isset($install_lock['access_token']) ? $install_lock['access_token'] : '';
                Cache::set('accredit_token',$token,3600*3);
            }
        
        }
        return $token;
    }
    
    /**
     * 版本检测（获取云端版本）
     * 
     * @author 牧羊人
     * @date 2019-04-23
     */
    function getVersion()
    {
        $version_info = Cache::get('eacoophp_remote_version');
        if (!$version_info) {
            $eacoophp_version = EACOOPHP_V;
            $url = config('eacoo_api_url').'/eacoophp_version?epv='.urlencode($eacoophp_version);
            $result = curl_get($url);
            $version_info = json_decode($result, true);
            Cache::set('eacoophp_remote_version', $version_info,3600);
        }
        return $version_info; 
    }
    
    /**
     * 获取官方动态
     * 
     * @author 牧羊人
     * @date 2019-04-23
     */
    function getOfficialNews($data = [])
    {
        $eacoo_news = Cache::get('eacoo_news');
        if (!$eacoo_news) {
            $url        = config('eacoo_api_url').'/client_eacoo_news';
            $result     = curl_post($url, $data);
            $eacoo_news = json_decode($result, true);
            Cache::set('eacoo_news', $eacoo_news, 3600*3);
        }
        
        return $eacoo_news;
    }
    
    /**
     * 身份验证
     * 
     * @author 牧羊人
     * @date 2019-04-23
     */
    function identification()
    {
        try {
            $eacoo_identification = cache('eacoo_identification');
            if (!$eacoo_identification || !is_array($eacoo_identification)) {
                //需要重新登录
                throw new \Exception("请登录验证身份", 2);
            } else{
                $uid = $eacoo_identification['uid'];
                $access_token = $eacoo_identification['access_token'];
                $result = curl_request(config('eacoo_api_url').'/api/user',['uid'=>$uid,'token'=>$access_token],'GET');
        
                $result = json_decode($result['content'],true);
                if ($result['code']==1) {
                    $return =[
                        'code'=>1,
                        'msg'=>'身份验证成功',
                        'data'=>$result['data']['userinfo'],
                    ];
                    return $return;
                } else{
                    if ($result['code']==2) {
                        cache('eacoo_identification',null);
                    }
                    //需要重新登录
                    throw new \Exception($result['msg'], $result['code']);
                }
        
            }
        
        } catch (\Exception $e) {
            return [
                'code'=>$e->getCode(),
                'msg'=>$e->getMessage(),
                'data'=>[],
            ];
        }
    }
    
}