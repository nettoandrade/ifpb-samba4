<?php 
include 'check.php';
include 'connection.php';
?>
<form action="processo.php?page=gremove" method="POST">
<h4>Nome: </h4>
<input type="text" name="group" id="grupo" placeholder="Grupo">
<input type="submit" value="Enviar">
<input type="reset" value="Limpar">
</form>