<?php 
include 'sessao/check.php';
include 'sessao/connection.php';
?>
<h4>DOMÍNIO: </h4>
	<p><?php 
	$output = shell_exec("cat /usr/local/samba/etc/smb.conf | grep realm | cut -d = -f 2");
	echo "$output";
	?></p>
	<hr>
	<h4>STATUS:</h4>
	<p id="status"><?php
	$output = shell_exec("ps aux | grep samba | wc -l");
	if ($output > 2) {
		echo "OK";
	}
	else {

		echo "Fail";
	}
	?></p>
	<button id="iniciar">Iniciar</button>
	<button id="stop">Stop</button><br>
	<div id="processes">
	<?
	$output = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool processes');
	stream_set_blocking($output, true);
	$cmd = stream_get_contents($output);
	$cmd = str_replace("\n", "<br>", $cmd);
	echo $cmd;
	?>
	</div>