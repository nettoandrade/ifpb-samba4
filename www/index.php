<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/estilo.css">
	<script language="JavaScript" src="js/jquery-1.3.2.js" type="text/javascript"></script>
  	<script language="JavaScript" type="text/javascript">
  	$(function() {
  		// Evento de clique do elemento: ul#menu li.parent > a
  		$('ul#menu li.parent > a').click(function() {
  			// Expande ou retrai o elemento ul.sub-menu dentro do elemento pai (ul#menu li.parent)
  			$('ul.sub-menu', $(this).parent()).slideToggle('fast', function() {
  				// Depois de expandir ou retrair, troca a classe 'aberto' do <a> clicado       
  				$(this).parent().toggleClass('aberto');
  			});
			return false;
  		});
  	});
  </script>
</head>
<body>
<header>
<h1>SAMBA 4</h1>
<h4>Controlador de dominio</h4>
</header>

<div id="menu1">
	<ul id="menu">
	<li class="header">MENU</li>
	<li><a href="/samba4" title="">Status</a></li>
	<li class="parent"><a href="#" title="">Usuários</a>
		<ul class="sub-menu">
			<li><a href="adicionar.html">Adicionar</a></li>	
			<li><a href="#">Remover</a></li>
			<li><a href="listar.php">Listar</a></li>
			<li><a href="#">Desabilitar</a></li>
			<li><a href="#">Habilitar</a></li>
			<li><a href="#">Alterar senha</a></li>
		</ul>
	</li>
	<li class="parent"><a href="#" title="">Grupos</a>
		<ul class="sub-menu">
			<li><a href="#">Adicionar</a></li>	
			<li><a href="#">Remover</a></li>
			<li><a href="#">Listar</a></li>
			<li><a href="#">Permissões</a></li>
		</ul>
	</li>
	<li class="parent"><a href="#" title="">Compartilhamentos</a>
		<ul class="sub-menu">
			<li><a href="#">Adicionar</a></li>	
			<li><a href="#">Remover</a></li>
			<li><a href="#">Listar</a></li>
			<li><a href="#">Permissões</a></li>
		</ul>
	</li>
</ul>
</div>
<div id="main">
	<h4>DOMÍNIO: </h4>
	<p><?php 
	$output = shell_exec("cat /usr/local/samba/etc/smb.conf | grep realm | cut -d = -f 2");
	echo "$output";
	?></p>
	<hr>
	<h4>STATUS:</h4>
	<p><?php
	$output = shell_exec("ps aux | grep samba | wc -l");
	if ($output > 2) {
		echo "OK";
	}
	else {
		echo "Fail";
	}
	?></p><br>
	<h4>COMPARTILHAMENTOS: </h4><br>
	<p>Compartilhamento</p><br>
	<p>Arquivos</p><br>
	<p>Temporário</p>

</div>
</body>
</html>