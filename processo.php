<?php
	$nome = $_POST['name'];
	$senha = $_POST['password'];
	shell_exec("/usr/local/samba/bin/samba-tool user create ".$nome." ".$senha);
	//echo "/usr/local/samba/bin/samba-tool user create ".$nome." ".$senha;
?>