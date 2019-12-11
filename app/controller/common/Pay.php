<?php

namespace app\controller\common;


use app\services\GzhNotifyService;
use app\model\SysConfig;
use app\services\PayService;
use app\services\WxNotifyService;
use app\services\TokenService;
use app\validate\IDPostiveInt;
use bases\BaseController;
use app\model\Order as OrderModel;
use GzhPay\JsApi;
use GzhPay\WxPayConfig;

class Pay extends BaseController
{
    //公众号-我的订单页面中进行支付
    public function gzhPaySecond($id)
    {
       (new IDPostiveInt())->goCheck();
        $order=OrderModel::find(['order_id'=>$id]);
        $order_data['order_num']=$order['order_num'];
        $order_data['order_money']=$order['order_money'];
        $openid=TokenService::getCurrentTokenVar('openid');
        $gzh['web_name']=SysConfig::where(['key'=>'web_name'])->value('value');
        $gzh['api_url']=SysConfig::where(['key'=>'api_url'])->value('value');
        $res=(new JsApi())->gzh_pay($openid,$order_data,$gzh);
        return $res;
    }

    //公众号回调
    public function gzh_back()
    {
        $config = new WxPayConfig();
        Log::error("begin notify");
        $notify = new GzhNotifyService();
        $notify->Handle($config, false);
    }

    //获取调用小程序支付，必须的数据
    public function getPreOrder($id = '')
    {
        (new IDPostiveInt())->goCheck();
        $pay = new PayService($id);
        return $pay->pay();
    }

    //小程序支付回调
    public function receiveNotify()
    {
       session('notify',true); 
        $notify = new WxNotifyService();
        $notify->Handle();
    }

}