<?
	include 'check.php';
	include 'connection.php';

	ssh2_exec($connection, '/usr/local/samba/sbin/samba');
	header('Location:index.php');
?>