<?php 
include 'sessao/check.php';
include 'sessao/connection.php';
?>
<form action="processo.php?page=setpwd" method="POST">
<h4>Nome: </h4>
<input type="text" name="name" placeholder="Nome">
<h4>Senha: </h4>
<input type="password" name="password" placeholder="Nova Senha"><br>
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