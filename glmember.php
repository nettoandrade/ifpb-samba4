<?php 
include 'sessao/check.php';
include 'sessao/connection.php';

$output = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool group listmembers redes');
stream_set_blocking($output, true);
$cmd = stream_get_contents($output);
$cmd = explode("\n", $cmd);
?>
<table>
		<thead>
			<tr>
				<th><h2>Grupo de usuários: </h2></th>
			</tr>
		</thead>
		<tbody>
		<?foreach ($cmd as $value) {?>
				<td><?=$value?></td>
			</tr>
		<?}?>
		</tbody>
</table>