<?php
include 'sessao/check.php';
include 'sessao/connection.php';

extract($_POST);

function listar(){

	$var = $_POST['name'];

	if ($page == 'group'){

		$output = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user list');
		stream_set_blocking($output, true);
		$cmd = stream_get_contents($output);
		$cmd = explode("\n", $cmd);
	}
	elseif ($page == 'user') {
	
		$output = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool group list');
		stream_set_blocking($output, true);
		$cmd = stream_get_contents($output);
		$cmd = explode("\n", $cmd);
	}

	return $cmd;


}
?>