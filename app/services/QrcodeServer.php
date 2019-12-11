<?php

namespace app\services;
use phpqrcode\phpqrcode;

class QrcodeServer
{
    public function get_qrcode($code)
    {
        $level = 'L';// 纠错级别：L、M、Q、H
        $size =4;// 点的大小：1到10,用于手机端4就可以了
        $QRcode = new phpqrcode();
        ob_start();
        $QRcode->png($code,false,$level,$size,2);
        $imageString = base64_encode(ob_get_contents());
        ob_end_clean();
        return "data:image/jpg;base64,".$imageString;
    }
    public function getCode($code)
    {
        $level = 'L';// 纠错级别：L、M、Q、H
        $size =4;// 点的大小：1到10,用于手机端4就可以了
        $QRcode = new phpqrcode();
        ob_start();
        $QRcode->png($code,false,$level,$size,2);
        $imageString = ob_get_contents();
        ob_end_clean();
        $url='./uploads/code.jpg';
        file_put_contents($url, $imageString);
    }
}