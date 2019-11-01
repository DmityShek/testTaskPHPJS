<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
define('ROOT', __DIR__);
require_once(ROOT.'/core/Autoloader.php');

session_start();

$router = new Router();
$router->run();
