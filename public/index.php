<?php
require __DIR__.'/../vendor/autoload.php';
include __DIR__ .'/../App/dd.php';
session_start();
define('STORAGE_PATH','../Storage/');
define('VIEW_PATH','../view/');

include __DIR__.'/router.php';














