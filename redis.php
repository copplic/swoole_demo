<?php
/**
 * Created by PhpStorm.
 * User: pp
 * Date: 2017/12/4
 * Time: 15:49
 */

$redis = new Swoole\Redis;
$redis->connect('127.0.0.1', 6379, function ($redis, $result) {
    $redis->set('test_key', 'value', function ($redis, $result) {
        $redis->get('test_key', function ($redis, $result) {
            var_dump($result);
        });
    });
});