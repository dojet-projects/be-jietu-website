<?php
define('DBDEMO',    'DBDEMO');

$__c = &Config::configRefForKeyPath('database');

$__c[C_RUNTIME_MAC2010] = array(
    DBDEMO => array(
        'r' => array(
            'hosts' => array(
                array('h' => '127.0.0.1', 'p' => 3306),
                ),
            'username' => 'root',
            'password' => 'root',
            'dbname' => 'demo',
            'charset' => 'utf8',
            'timeout' => 1, //sec
        ),
        'w' => array(
            'hosts' => array(
                array('h' => '127.0.0.1', 'p' => 3306),
                ),
            'username' => 'root',
            'password' => 'root',
            'dbname' => 'demo',
            'charset' => 'utf8',
            'timeout' => 1, //sec
        ),
    ),
);

unset($__c);
