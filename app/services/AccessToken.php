<?php

namespace app\services;
use app\model\SysConfig;javascript:;
use exceptions\BaseException;
use think\Exception;

class AccessToken
{
    private $tokenUrl;
    const TOKEN_CACHED_KEY = 'access';
    const TOKEN_EXPIRE_IN = 7000;

    function __construct()
    {

        $arr=SysConfig::where(['type'=>2])->select();
        $cg=[];
        foreach ($arr as $k=>$v){
            if(in_array($v['key'],['gzh_appid','gzh_secret','wx_app_id','wx_app_secret'])){
                $cg[$v['key']]=$v['value'];
            }
        }
        if(empty($cg['gzh_appid']) && empty($cg['wx_appid'])) {
            throw new BaseException(['msg'=>'缺少appid']);
        }
        if(empty($cg['gzh_secret']) && empty($cg['wx_app_secret'])) {
            throw new BaseException(['msg'=>'缺少secret']);
        }
        $appid=$cg['gzh_appid']?$cg['gzh_appid']:$cg['wx_appid'];
        $secret=$cg['gzh_secret']?$cg['gzh_secret']:$cg['wx_app_secret'];
       
        $url = config('setting.access_token_url');
        $url = sprintf($url, $appid,$secret);
        $this->tokenUrl = $url;
    }

    // 建议用户规模小时每次直接去微信服务器取最新的token
    // 但微信access_token接口获取是有限制的 2000次/天
    public function get()
    {
        $token = $this->getFromCache();
        if (!$token)
        {
            return $this->getFromWxServer();
        }else {
            return $token;
        }
    }

    private function getFromCache()
    {
        $token = cache(self::TOKEN_CACHED_KEY);
        if ($token)
        {
            return $token;
        }
        return null;
    }


    private function getFromWxServer()
    {
        $token = curl_get($this->tokenUrl);
        $token = json_decode($token, true);
        if (!$token)
        {
            throw new BaseException('获取AccessToken异常');
        }
        if (!empty($token['errcode']))
        {
            throw new BaseException(['msg'=>$token['errmsg']]);
        }
        $this->saveToCache($token);
        //return $token['access_token'];
      	return $token;
    }

    private function saveToCache($token){
        cache(self::TOKEN_CACHED_KEY, $token, self::TOKEN_EXPIRE_IN);
    }
}