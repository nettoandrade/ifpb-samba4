<?php 
include 'sessao/check.php';
include 'sessao/connection.php';

//Lista os grupos
$output = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool group list');
stream_set_blocking($output, true);
$cmd = stream_get_contents($output);
$cmd = explode("\n", $cmd);

?>

<form action="index.php?page=grmember" method="post">
	
	<h4>Grupos</h4>
		<select style="font-size: 16px;" name="group">
			<?foreach ($cmd as $value) {?>
			<option><?=$value?></option>
			<?}?>
	</select><br>
	<input type="submit" value="Listar">

</form>

<?php

$removerGrupo = $_POST['group'];
$output2 = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool group listmembers '.$removerGrupo);
stream_set_blocking($output2, true);
$cmd2 = stream_get_contents($output2);
$cmd2 = explode("\n", $cmd2);

?>

<form action="processo.php?page=grmember" method="post">
	
	<h4>Membros</h4>
		<select style="font-size: 16px;" name="name">
			<?foreach ($cmd2 as $value) {?>
			<option><?=$value?></option>
			<?}?>
	</select><br>

	<input type="submit" value="Remover">
</form>

