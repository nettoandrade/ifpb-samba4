<?php 
include 'check.php';
include 'connection.php';

$output = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user list');
stream_set_blocking($output, true);
$cmd = stream_get_contents($output);
$cmd = explode("\n", $cmd);
?>
<table>
		<thead>
			<tr>
				<th>Usuarios :</th>
			</tr>
		</thead>
		<tbody>
		<?foreach ($cmd as $value) {?>
				<td><?=$value?></td>
			</tr>
		<?}?>
		</tbody>
</table>