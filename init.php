<?php
require dirname(__FILE__).'/../be-dojet/dojet.php';
require dirname(__FILE__).'/../be-global/init.php';
require dirname(__FILE__).'/../be-jietu-global/init.php';

define('UI', PRJ.'ui/');
define('CONFIG', PRJ.'config/');
define('MODEL', PRJ.'model/');

Config::loadConfig(CONFIG.'route');
//Config::loadConfig(CONFIG.'database');
// Config::loadConfig(CONFIG.'fileupload');

DAutoloader::getInstance()->addAutoloadPathArray(
    array(
        dirname(__FILE__).'/dal/',
    )
);

// Dojet::addModule(__DIR__.'/../mod-simplecms');

// ModuleSimpleCMS::module()->setDatabase(DBDEMO);
// ModuleFileUpload::setUploadRoot(Config::runtimeConfigForKeyPath('fileupload.upload'));
// ModuleFileUpload::setPublishRoot(Config::runtimeConfigForKeyPath('fileupload.publish'));
// ModuleFileUpload::setUrlRoot('http://www.sina.com.cn');
