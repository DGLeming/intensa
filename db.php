<?php
$host = 'sql8.freesqldatabase.com';
$db = 'sql8701332';
$user = 'sql8701332';
$password = 'alJpZWQ2Jc';
date_default_timezone_set('UTC');
// echo time();
// $timestamp = strtotime('2024-04-23 19:00:44');
//print_r($_SERVER);
//charset=cp1251
$dsn = "mysql:host=$host;dbname=$db;charset=utf-8";
try {
	$pdo = new PDO($dsn, $user, $password);
	banned($pdo, $_SERVER['REMOTE_ADDR']);
	//$pdo->exec("SET NAMES = utf-8");
} catch (PDOException $e) {
	echo $e->getMessage();
}

function postNewLid($pdo, $email, $name, $phone, $city){
	$sth = $pdo->prepare("INSERT INTO `lids` SET `email` = :email, `name` = :name, `phone` = :phone, `city` = :city, `ip` = :ip");
	$sth->execute(array('email' => $email, 'name' => $name, 'phone' => $phone, 'city' => $city, 'ip' => $_SERVER['REMOTE_ADDR']));

	//after inserting new lid - check if user exceeded limit of 5 lids per hour
	isSpammer($pdo, $_SERVER['REMOTE_ADDR']);

	echo 'Данные отправлены';
}
function isSpammer($pdo, $ip){
	$sth = $pdo->prepare("SELECT date FROM `lids` WHERE ip = ?");
	$sth->execute(array($ip));
	$array = $sth->fetchAll();
	$count = 0;
	//server was setting default time very strangely, so its just arbitary offset
	$serverTimeOffset = 3600+220;
	forEach($array as $lid){
		if((time()-$serverTimeOffset-strtotime($lid['date']))<3600)
		$count++;
	}
	if($count > 5){
		$sth = $pdo->prepare("INSERT INTO `bans` SET `time` = :time, `ip` = :ip");
		$sth->execute(array('time' => time(), 'ip' => $_SERVER['REMOTE_ADDR']));
	}
}

function banned($pdo, $ip){
	//echo time();
	$sth = $pdo->prepare("SELECT time FROM `bans` WHERE ip = ? AND time > ?");
	$sth->execute(array($ip, time()-3600));
	$array = $sth->fetchAll();
	//echo count($array);
	if(count($array) > 0){
		//echo 'banned';
		header("Location: /banned.php");
		//prep_url('/banned.php');
	}
	//print_r($array);
}

// banned at 1000
// current 1100
// banned till 3600+1000
// check if current < banned + 3600
// banned  > current - 3600