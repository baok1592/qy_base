<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/8 0008
 * Time: 10:09
 */

namespace subscribes;

use app\services\DeliveryMessage;
use app\services\GzhDeliveryMessage;

/**
 * 订单事件
 * Class msgSubscribes
 * @package subscribes
 */
class msgSubscribes
{
    public function handle()
    {

    }
    /**
     * 公众号发送模板消息通知管理员
     * @param $event
     */
    public function onSendGzhDeliveryMessage($event)
    {

        list($data,$type,$ids)=$event;
        $message = new GzhDeliveryMessage();
         $message->sendDeliveryMessage($data,$type,$ids);  //公众号发送模板消息通知管理员
    }

    /**
     * 小程序发送模板消息通知用户
     * @param $event
     */
    public function onSendDeliveryMessage($event)
    {
        $message = new DeliveryMessage();
        $message->sendDeliveryMessage($event, '');//小程序发送模板消息通知用户
    }
}