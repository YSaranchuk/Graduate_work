<?php
session_start();
ini_set('error_reporting', E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$config = include __DIR__ . '/config.php';

include 'upload/database/DataBase.php';

$db = DataBase::connect(
	$config['mysql']['host'],
	$config['mysql']['dbname'],
	$config['mysql']['user'],
	$config['mysql']['pass']
);

include 'upload/router/router.php';
