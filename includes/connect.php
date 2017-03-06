<?php
$host = 'localhost';
$user = 'root';
$pass = 'WoJtEk141169';
$db = 'skladak';

try {
	$db = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
	echo "Connection Error: " . $e->getMessage();
	die();
}
?>
