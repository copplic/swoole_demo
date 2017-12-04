<?php
/**
 * Created by PhpStorm.
 * User: pp
 * Date: 2017/12/4
 * Time: 9:43
 */

//创建端口
$serv = new swoole_server("127.0.0.1", 9501);


//监听连接进入事件
$serv -> on("connect", function($serv, $fd){
    echo "Client Connect.\n";
});


//监听数据接收事件
$serv->on("receive", function($serv, $fd, $form_id, $data){
    $serv->send($fd, "Server:".$data);
});


//监听连接关闭事件
$serv->on("close", function($serv, $fd){
    echo "Client: Close.\n";
});

$serv->start();