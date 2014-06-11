<?
	require_once 'connectiondb.php';

	$sql = file_get_contents('logs.sql');
	$connection = getDBConnection(null);

	$connection->exec($sql);
	header("Location:index.php");
?>