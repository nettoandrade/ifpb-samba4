<?
	function getDBConnection($dbname = "samba4"){
		$user = "root";
		$password = "root";
		$db = "mysql";
		$host = "localhost";
		$dsn = ($dbname=="samba4")?"$db:dbname=$dbname;host=$host":"$db:host=$host";
		try { // Database Error Handling
			return new PDO($dsn, $user, $password);
		} catch (Exception $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
		
		
	}
?>