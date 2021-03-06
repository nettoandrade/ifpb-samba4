<?
 include 'sessao/check.php';
 include 'sessao/connection.php';
 $page = (isset($_GET['page']))?$_GET['page'].".php":"status.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Samba 4</title>
	<link rel="stylesheet" type="text/css" href="css/estilo2.css">
	<link rel="stylesheet" href="css/estilo.css">
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
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

<body style="background-color: #CFCFCF;">
<div id="logo">
	<header id="index">
	<h1>SAMBA 4</h1>
	<h4>Controlador de dominio</h4>
	</header>
</div>

<div id="menu1">
	<ul id="menu">
	<li class="header">MENU</li>
	<li><a href="/ifpb-samba4/index.php" title="">Status</a></li>
	<li class="parent"><a href="#" title="">Usuários</a>
		<ul class="sub-menu">
			<li><a href="#add" id="add">Adicionar</a></li>	
			<li><a href="#remove" id="remove">Remover</a></li>
			<li><a href="#list" id="list">Listar</a></li>
			<li><a href="#disable" id="disable">Desabilitar</a></li>
			<li><a href="#enable" id="enable">Habilitar</a></li>
			<li><a href="#setpwd" id="setpwd">Alterar senha</a></li>
		</ul>
	</li>
	<li class="parent"><a href="#" title="">Grupos</a>
		<ul class="sub-menu">
			<li><a href="#gcreate" id="gcreate">Criar</a></li>	
			<li><a href="#gremove" id="gremove">Remover</a></li>
			<li><a href="#glist" id="glist">Listar grupos</a></li>
			<li><a href="#gmember" id="gmember">Adicionar membro</a></li>
			<li><a href="#grmember" id="grmember">Remover membro</a></li>
			<li><a href="#glmember" id="glmember">Listar membros</a></li>
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
	<li><a href="/ifpb-samba4/logout.php" title="">Logout</a></li>
	<li><a href="#" id="logs" title="">Logs de Acesso</a></li>
	</ul>
</div>
<div id="scroll">
	<? include_once $page ?>
</div>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script>
	
	if($('#status').html() == "OK")
		$('#iniciar').hide();
	else{
		$('#processes').hide();
		$('#stop').hide();
	}
	$('#iniciar').click(function(){window.location='index.php?page=iniciar'});
	$('#stop').click(function(){window.location='index.php?page=iniciar&flag=1'});
	$('#add').click(function(){window.location='index.php?page=create'});
	$('#list').click(function(){window.location='index.php?page=list'});
	$('#remove').click(function(){window.location='index.php?page=remove'});
	$('#disable').click(function(){window.location='index.php?page=disable'});
	$('#enable').click(function(){window.location='index.php?page=enable'});	
	$('#setpwd').click(function(){window.location='index.php?page=setpwd'});
	$('#glist').click(function(){window.location='index.php?page=glist'});
	$('#gcreate').click(function(){window.location='index.php?page=gcreate'});
	$('#gremove').click(function(){window.location='index.php?page=gremove'});
	$('#glist').click(function(){window.location='index.php?page=glist'});
	$('#gmember').click(function(){window.location='index.php?page=gmember'});
	$('#grmember').click(function(){window.location='index.php?page=grmember'});
	$('#glmember').click(function(){window.location='index.php?page=glmember'});
	$('#logs').click(function(){window.location='index.php?page=logs'});
	</script>
</body>
</html>