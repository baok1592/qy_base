<?php
// 事件定义文件
return [
    'bind' => [
    ],

    'listen' => [
    ],

    'subscribe' => [
        subscribes\msgSubscribes::class,//模板消息订阅时间
    ],
];
