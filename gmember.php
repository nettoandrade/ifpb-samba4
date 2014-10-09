<?php 
include 'sessao/check.php';
include 'sessao/connection.php';



$output = ssh2_exec($connection, '/usr/local/samba/bin/samba-tool group list');
stream_set_blocking($output, true);
$cmd = stream_get_contents($output);
$cmd = explode("\n", $cmd);

?>

<form method="post">
<select id="selectBox" onchange="changeFunc();" name="grupo">
<?foreach ($cmd as $value) {?>
	<option selected="selected"><?=$value?></option>
	<?}?>

</select>
 <input type="submit" value="Listar">

</form>


<?php
	$nomeGrupo = $_POST['grupo'];
	$output2 =  ssh2_exec($connection, '/usr/local/samba/bin/samba-tool group listmembers'.$nomeGrupo);
	stream_set_blocking($output2, true);
	$cmd2 = stream_get_contents($output2);
	$cmd2 = explode("\n", $cmd2);
?>

<form action="index.php?page=glmember" method="post">
<select  name="grupo">
<?foreach ($cmd2 as $value2) {?>
	<option selected="selected"><?=$value2?></option>
	<?}?>

</select><br>
 <input type="submit" value="Remover">

</form>