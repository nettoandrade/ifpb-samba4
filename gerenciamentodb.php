<?
	require_once "connectiondb.php";

	$connection = getDBConnection();

	function insert($user){
		global $connection;
		$Set = $connection->prepare("INSERT INTO logs (user , time) VALUES (:user, CURRENT_TIMESTAMP)");
		$Set->bindValue(":user", $user);
		return $Set->execute();
	};

	function read(){
		global $connection;
		$Set = $connection->query("SELECT * FROM logs");
		return $Set->fetchAll();
	};

?>