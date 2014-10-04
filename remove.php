<?php 
include 'sessao/check.php';
include 'sessao/connection.php';
?>
<form action="processo.php?page=remove" method="POST">
<h4>Nome: </h4>
<input type="text" name="name" id="name" placeholder="Nome">
<input type="submit" value="Enviar">
<input type="reset" value="Limpar">
</form>
<h2>Usuarios: </h2>
<?
$output = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user list');
stream_set_blocking($output, true);
$cmd = stream_get_contents($output);
$cmd =str_replace("\n", "<br>", $cmd);
echo $cmd;
?>