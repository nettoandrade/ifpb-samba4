<?php
$connection = ssh2_connect('localhost', 22);

if (ssh2_auth_password($connection, 'root', 'ant2011@x')) {
  echo "Authentication Successful!</br>";
} else {
  die('Authentication Failed...');
}

echo "\n";

$retorno = ssh2_exec($connection, 'ls -l /');
//var_dump($retorno);
stream_set_blocking($retorno, 1);
$cmd = stream_get_contents($retorno);

$cmd = str_replace("\n", "<br>", $cmd);

echo $cmd;

$retorno = ssh2_exec($connection, 'ls -l /home');
stream_set_blocking($retorno, 1);
$cmd = stream_get_contents($retorno);
//echo filesize($retorno);
//$cmd = fread($retorno, 4098);
var_dump($cmd);

//echo "Output </br>". $cmd;
echo $cmd;

fclose($retorno);

?>