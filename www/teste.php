<?php

	//$output = shell_exec("/usr/local/samba/bin/samba-tool user list");
	$output = shell_exec("/usr/local/samba/bin/samba-tool user list");
	$output = str_replace("\n", "<br>", $output);
	echo $output;
	
?>