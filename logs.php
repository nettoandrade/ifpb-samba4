<?
	include 'check.php';
	require_once "gerenciamentodb.php";

	$logs = read();
?>
	<table border="1">
		<thead>
			<tr>
				<th>User</th>
				<th>Time</th>
			</tr>
		</thead>
		<tbody>
		<?foreach ($logs as $log) {?>
			<tr>
				<td><?=$log['user']?></td>
				<td><?=$log['time']?></td>
			</tr>
		<?}?>
		</tbody>
	</table>
