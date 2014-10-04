<?
	include 'sessao/check.php';
	include 'sessao/connection.php';
	extract($_GET);
	if (isset($flag)) 
		ssh2_exec($connection, 'killall samba');	

	ssh2_exec($connection, '/usr/local/samba/sbin/samba');
	header('Location:index.php');
?>