<?php
/**
 * Created by PhpStorm.
 * User: pp
 * Date: 2017/12/4
 * Time: 10:12
 */

//创建server对象，类型为SWOOLE_SOCK_UDP
$serv = new swoole_server("127.0.0.1", 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

//监听数据接收事件
$serv->on("Packet",function ($serv, $data, $clientInfo){
    $serv->sentto($clientInfo['address'],$clientInfo['port'],"Server ".$data);
    var_dump($clientInfo);
});

//启动
$serv->start();