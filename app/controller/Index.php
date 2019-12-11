<?php
namespace app\controller;

use app\services\GzhDeliveryMessage;
use bases\BaseController;
use events\OrderEvent;
use exceptions\ProductException;
use services\QyFactory;
use traits\UserTrait;

class Index extends BaseController
{
    use UserTrait;
    public function index()
    {
        echo '演示系统';
    }


}


