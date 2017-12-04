<?php
/**
 * Created by PhpStorm.
 * User: pp
 * Date: 2017/12/4
 * Time: 15:43
 */

$db = new Swoole\MySQL;
$server = array(
    'host' => '127.0.0.1',
    'user' => 'root',
    'password' => 'Abc123456789!',
    'database' => 'test',
);

$db->connect($server, function ($db, $result) {
    $db->query("show databases", function (Swoole\MySQL $db, $result) {
        var_dump($result);
        $db->close();
    });
});