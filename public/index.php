<?php
define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */

define('VIEW_PATH', APP_PATH . '/application/views/');

define('LIB_PATH', APP_PATH . '/application/library/');

$app  = new Yaf_Application(APP_PATH . "/conf/application.ini");

$app->bootstrap()->run();
