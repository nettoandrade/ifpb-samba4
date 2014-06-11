<?php 
include 'check.php';
include 'connection.php';
?>
<form action="processo.php?page=gcreate" method="POST">
<h4>Nome: </h4>
<input type="text" name="group" placeholder="Grupo">
<input type="submit" value="Adicionar">
<input type="reset" value="Limpar">
</form>