<?php


namespace app\services;


use think\Exception;
use think\facade\Log;


//公众号模板消息
class GzhMessage
{
    private $sendUrl = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=%s";
    private $touser;
    private $color = 'black'; //不让子类控制颜色

    protected $tplID;
    protected $page;
    protected $formID;
    protected $data;
    protected $emphasisKeyWord;

    protected function AccessToken()
    {
        $accessToken = new AccessToken();
        $token = $accessToken->get();
        $this->sendUrl = sprintf($this->sendUrl, $token['access_token']);//把百分号（%）符号替换成一个作为参数进行传递的变量：
    }

    // 开发工具中拉起的微信支付prepay_id是无效的，需要在真机上拉起支付
    protected function sendMessage($openID)
    {
        Log::error('sendMessage');
        $data = [
            'touser' => $openID,
            'template_id' => $this->tplID,
            'url'=>"",
            'data' => $this->data,
        ];
      //dump($data);
      //exit;
        $result = curl_post($this->sendUrl, $data);
        $result = json_decode($result, true);
      
        Log::error($result);
        if ($result['errcode'] == 0) {
            return true;
        } else {
            Log::error(json_encode($result));
            throw new Exception('服务通知发送失败,  ' . $result['errmsg']);
        }
    }
}