<?php
session_start();
session_regenerate_id();

include_once("sources/php/config.php");
include_once("sources/php/functions/functions.php");
include_once("sources/php/classes/classes.php");

$user = new User($conn);

if($user -> checkPassword($conn, $_POST['login'], $_POST['password'])){
	$_SESSION['username'] = filter($conn, $_POST['login']);
	$_SESSION['hashedUsername'] = encrypt_decrypt(filter($conn, $_POST['login']));
	header("Location: dashboard.php");
}else{
	header("Location: error.php?type=0");
}
?>