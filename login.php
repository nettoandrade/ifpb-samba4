<?
	include "gerenciamentodb.php";
	extract($_POST);
		$conexao = ssh2_connect('localhost', $port);
		$flag = ssh2_auth_password($conexao, $login, $senha);
		if($flag){
			session_start();
			$_SESSION['logado'] = true;
			$_SESSION['login'] = $login;
			$_SESSION['senha'] = $senha;
			$_SESSION['port'] = $port;
			insert($login);
			header('Location:index.php');
		}
		else{
			header('Location:login.html');
			fclose($conexao);
		}
?>