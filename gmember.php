<?php 
include 'sessao/check.php';
include 'sessao/connection.php';


$output = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool group list');
stream_set_blocking($output, true);
$cmd = stream_get_contents($output);
$cmd = explode("\n", $cmd);


$output2 =  ssh2_exec($connection, '/usr/local/samba/bin/samba-tool user list');
stream_set_blocking($output2, true);
$cmd2 = stream_get_contents($output2);
$cmd2 = explode("\n", $cmd2);


?>

<form method="post" action="processo.php?page=gmember">

<h4>Grupos:</h4>
<select id="selectBox" name="group">
<?foreach ($cmd as $value) {?>
	<option selected="Users"><?=$value?></option>
	<?}?>
</select>

<h4>Usuário:</h4>
<select name="name">
<?foreach ($cmd2 as $value2) {?>
	<option selected="selected"><?=$value2?></option>
	<?}?>
</select><br>
 <input type="submit" value="Adicionar">

</form>
