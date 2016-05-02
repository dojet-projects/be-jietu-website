#!/usr/bin/php
<?php
include dirname(__FILE__).'/script_init.php';

if ($pid = pcntl_fork()) {
    exit();
}

$redis = new Redis();
while (true) {
    try {
        $redis->connect('10.100.149.158', 6379, 5);
        $ret = $redis->subscribe(array('TEST:a'), 'callback');
    } catch (Exception $e) {
        var_dump($e);
        continue;
    }
}

function callback($instance, $channel, $message) {
    var_dump(func_get_args());
}
