<?php 
include 'check.php';
include 'connection.php';

$output = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool group list');
stream_set_blocking($output, true);
$cmd = stream_get_contents($output);
$cmd =str_replace("\n", "<br>", $cmd);
echo $cmd;
?>