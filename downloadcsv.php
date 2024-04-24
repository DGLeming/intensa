<?php
require 'db.php';

$city = $_GET['city'];
if($city == null){
	$sth = $pdo->prepare("SELECT * FROM `lids`");
	$sth->execute();
	$array = $sth->fetchAll();
	//print_r($array);
} else {
	$sth = $pdo->prepare("SELECT * FROM `lids` WHERE city = ?");
	$sth->execute(array($city));
	$array = $sth->fetchAll();
	//print_r($array[1]);
}


$lids = array();
foreach($array as $lid) { 
  $lids[] = array(
    'id'       => $lid['id'],
    'data=e'     => $lid['date'],
    'email' => $lid['email'],
    'name'    => $lid['name'],
    'phone'    => $lid['phone'],
    'city'    => $lid['city'],
  );
}
header("Content-type: text/csv"); 
header("Content-Disposition: attachment; filename=file.csv"); 
header("Pragma: no-cache"); 
header("Expires: 0"); 
 
$buffer = fopen('php://output', 'w'); 
fputs($buffer, chr(0xEF) . chr(0xBB) . chr(0xBF));
foreach($lids as $val) { 
  fputcsv($buffer, $val, ';'); 
} 
fclose($buffer); 
exit();
?>