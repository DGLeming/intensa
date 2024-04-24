<?php
require 'db.php';
require 'validCities.php';

function validate_city($cities, $city_post){
	$valid = false;
	forEach($cities as $city){
	    if($city['key'] == $city_post) $valid = true;
	}
	return $valid;
}

function validate_russian_phone_number($tel)
{
    $tel = trim((string)$tel);
    if (!$tel) return false;
    $tel = preg_replace('#[^0-9+]+#uis', '', $tel);
    if (!preg_match('#^(?:\\+?7|8|)(.*?)$#uis', $tel, $m)) return false;
    $tel = '+7' . preg_replace('#[^0-9]+#uis', '', $m[1]);
    if (!preg_match('#^\\+7[0-9]{10}$#uis', $tel, $m)) return false;
    return $tel;
}

function validate_name($name)
{
    $tel = trim((string)$tel);
    if (!$tel) return false;
    $tel = preg_replace('#[^0-9+]+#uis', '', $tel);
    if (!preg_match('#^(?:\\+?7|8|)(.*?)$#uis', $tel, $m)) return false;
    $tel = '+7' . preg_replace('#[^0-9]+#uis', '', $m[1]);
    if (!preg_match('#^\\+7[0-9]{10}$#uis', $tel, $m)) return false;
    return $tel;
}

$email = $_POST["email"];
$name = $_POST["name"];
$phone = $_POST['phone'];
$city = $_POST["city"];


$something_wrong = false;

//validate phone
if(validate_russian_phone_number($phone) == null) $something_wrong = true;

//validate name
if(!preg_match("/^\p{Lu}[\p{L} '&-]*[\p{L}]$/u", $name)) $something_wrong = true;

//validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $something_wrong = true;

//validate city
if(!validate_city($cities, $city)) $something_wrong = true;

if(!$something_wrong){
	//post to db
	postNewLid($pdo, $email, $name, $phone, $city);
} else {
	echo 'wrong data, request denied!';
}
?>