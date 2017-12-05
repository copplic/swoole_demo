<?php
/**
 * Created by PhpStorm.
 * User: pp
 * Date: 2017/12/5
 * Time: 10:04
 */
//测试

$serv = new swoole_server('0.0.0.0', 9501, SWOOLE_BASE, SWOOLE_SOCK_TCP);

$serv->set(array(
    'worker_num' => 2,
    'daemonize' => true,
    'backlog' => 128,
    'max_request'=>1000,

));

$serv->on('connect',  function($serv, $fd){
    echo "Client Connect.\n";
});
$serv->on('receive',  function($serv, $fd, $form_id, $data){

    //db do something
    $db = new Swoole\MySQL;
    $server = array(
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => 'Abc123456789!',
        'database' => 'test',
    );
    $db->connect($server, function ($db, $result) {
        $db->query("INSERT INTO test (`data`) VALUES(EMPTY_BLOB());", function (Swoole\MySQL $db, $result) {
            var_dump($result);
            $db->close();
        });
    });

    //send to server succeed message
    $serv->send($fd, "Server:save success!".$data);
});
$serv->on('close',  function($serv, $fd){
    echo "Client Close, 88~ \n";
});

$serv->start();
