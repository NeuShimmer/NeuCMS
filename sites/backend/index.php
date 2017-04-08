<?php
/**
 * 前台入口文件。
 * -- 1、入口文件会判断当前域名去加载配置文件。
 * @author winerQin
 * @date 2014-11-16
 */
xdebug_start_trace();
define('APP_ENVIRON', 'product');

// 微秒。
define('MICROTIME', microtime());

// -- 取当前目录名称 --
$pwd = trim(__DIR__, DIRECTORY_SEPARATOR);
$arr_pwd = explode(DIRECTORY_SEPARATOR, $pwd);
$app_name = array_pop($arr_pwd);
define('APP_NAME', $app_name);

define("APP_PATH", realpath(dirname(__FILE__) . '/../../'));

define('APP_SITE_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'sites' . DIRECTORY_SEPARATOR . APP_NAME);

define('APP_VIEW_PATH', APP_PATH . DIRECTORY_SEPARATOR .
     'apps' .
     DIRECTORY_SEPARATOR .
     $app_name .
     DIRECTORY_SEPARATOR .
     'views');
$app = new \Yaf\Application(APP_PATH . "/conf/application.ini", APP_ENVIRON);
$app->bootstrap()->run();