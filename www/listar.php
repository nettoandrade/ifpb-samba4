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
	<?php

	$output = shell_exec("/usr/local/samba/bin/samba-tool user list");
	$output = str_replace("\n", "<br>", $output);
	echo $output;
	
	?>

</div>
</body>
</html>