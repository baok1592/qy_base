<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/7 0007
 * Time: 15:38
 */

namespace app\services;


use app\model\FxOrder as FxOrderModel;
use app\model\Order as OrderModel;
use app\model\PtOrder;
use app\model\UserCoupon as UserCouponModel;

class TaskService
{
    /**
     * 循环任务 30分钟
     * @param $code
     * @return string
     */
    public function loopTask($code)
    {
        static $vaeIsInstalled;
        if (empty($vaeIsInstalled)) {
            $vaeIsInstalled = file_exists( VAE_ROOT . 'data/task.lock');
        }
//        $code = input('post.code');
        if($vaeIsInstalled){
            return '';
        }else{
            file_put_contents(VAE_ROOT . "data/task.lock", 'ruhua定时文件，勿删！！！！！此次安装时间：' . date('Y-m-d H:i:s', time()));
        }

        if ($code == '174369') {
            ignore_user_abort(); //即使Client断开(如关掉浏览器)，PHP脚本也可以继续执行.
            set_time_limit(0); // 执行时间为无限制，php默认的执行时间是30秒，通过set_time_limit(0)可以让程序无限制的执行下去
            $interval = 30 * 60; // 每隔2分钟运行
            do {
                OrderModel::closeOrder(); //关闭订单
                if(app('system')->getValue('is_pt')==1){
                    PtOrder::closeOrder();//关闭拼团订单
                }
                sleep($interval); // 按设置的时间等待5分钟循环执行
            } while (true);
        } else {
            return app('json')->fail();
        }
    }

    /**
     * 每日任务
     * @return mixed
     */
    public function DayTask(){
        try{
            UserCouponModel::delUserCoupon();//删除用户过期优惠券
            $this->onLoopTask();//检查循环任务是否正常
        }catch (\Exception $e){
            return app('json')->fail($e->getMessage());
        }

    }

    /**
     * 检查循环任务
     */
    public function onLoopTask(){
        $where['state']=0;
        $where['payment_state']=0;
        $time=time()-60*60;
       $res= OrderModel::where($where)->whereTime('create_time','<',$time)->find();
        if($res){
            if(unlink(VAE_ROOT . 'data/task.lock')){
                $this->loopTask('174369');
            }
        }

    }
}