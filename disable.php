<?php 
include 'sessao/check.php';
include 'sessao/connection.php';
?>
<form action="processo.php?page=disable" method="POST">
<h4>Nome: </h4>
<input type="text" name="name" id="name" placeholder="Nome">
<input type="submit" value="Enviar">
<input type="reset" value="Limpar">
</form>
<?

$output = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user list');
stream_set_blocking($output, true);
$cmd = stream_get_contents($output);
$cmd = explode("\n", $cmd);
?>
<table>
		<thead>
			<tr>
				<th><h2>Usuarios: </h2></th>
			</tr>
		</thead>
		<tbody>
		<?foreach ($cmd as $value) {?>
				<td><?=$value?></td>
			</tr>
		<?}?>
		</tbody>
</table>