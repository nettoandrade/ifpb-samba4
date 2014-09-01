<?
	session_start();
	extract($_SESSION);
	$connection = ssh2_connect('localhost', $port);
	$flag = ssh2_auth_password($connection, $login, $senha);
?>