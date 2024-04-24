<?php
$host = 'sql8.freesqldatabase.com';
$db = 'sql8701332';
$user = 'sql8701332';
$password = 'alJpZWQ2Jc';
date_default_timezone_set('UTC');

$dsn = "mysql:host=$host;dbname=$db;charset=utf-8";

try {
	$pdo = new PDO($dsn, $user, $password);
	//after db connect check if user banned
	banned($pdo, $_SERVER['REMOTE_ADDR']);
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
	$sth = $pdo->prepare("SELECT time FROM `bans` WHERE ip = ? AND time > ?");
	$sth->execute(array($ip, time()-3600*2));
	$array = $sth->fetchAll();

	if(count($array) > 0){
		header("Location: /banned.php");
	}
}