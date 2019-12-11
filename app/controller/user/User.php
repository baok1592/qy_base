<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/17 0017
 * Time: 9:03
 */

namespace app\controller\user;


use app\model\Order;
use app\services\TokenService;
use app\services\WxNotifyService;
use bases\BaseController;

class User extends BaseController
{
    /**
     * 模拟用户登录获取TOKEN
     * @return mixed
     */
    public function userLogin()
    {
        return (new TokenService())->saveCache(['uid' => 3,'openid' => 'oq_jb4mLWx97WOEn7x38yM0YkFhs']);
    }
}