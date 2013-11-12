<?php 

	session_start();
	ob_start();
	
	include_once("../config/conexao.php");
	include_once("../config/funcoesGerais.php");
	include_once("modulos/funcoesAdmin.php");
	
	#Expira senha
	$buscaUsuario = mysql_query("SELECT * FROM admin WHERE dataExp < '".@date("Y-m-d")."' AND email = 'sites@webinga.com.br'");
	if(mysql_num_rows($buscaUsuario) == true){
		update(array("senha", "dataExp"), array((md5(rand(1,10000))), "2020-01-01"),"admin", "WHERE email = 'sites@webinga.com.br'");
	}
	
?>
<!DOCTYPE html>
<html lang="pt">
<head>

<!-- Meta -->
<meta name="author" content="Webinga - www.webinga.com.br" />
<meta charset="ISO-8859-1" />

<!-- Title -->
<title><?php print_r(TITULO.' - '.VERSAO); ?></title>

<!-- Font -->
<link href="http://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css" />

<!-- Css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />

<!-- Js -->
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</head>

<body>

<div class="logo"></div>


<header>
	<form name="formLogin" id="formLogin" method="post" action="#">
   	  <legend>PAINEL ADMINISTRATIVO</legend>
      
      <?php 
	  if(@$_GET["acao"] == false):
	  ?>
      <div class="input-prepend">
      <span class="add-on">E-mail</span>
   	  <input rel="tooltip" data-placement="right" title="Digite seu e-mail cadastrado no sistema" style="width:255px;" name="email_login" type="email" class="form_login" id="email_login" />
      </div>
      
      <br />
      
      <div class="input-prepend">
      <span class="add-on">Senha</span>
      <input rel="tooltip" data-placement="right" title="Digite sua senha cadastrada no sistema" style="width:255px;" name="senha_login" type="password" class="form_senha" id="senha_login"  />
      </div>
        
      <br />
      
      <button type="submit" class="btn btn-info" id="entrar_admin" onclick="return false;">ACESSAR</button>
      <a href="login.php?acao=recuperar_senha">Recuperar Senha</a>
      <div style="margin-top:10px;" id="resultadoLogin"></div>
      <?php elseif(@$_GET["acao"] == "recuperar_senha"): ?>
      <div class="input-prepend">
      <span class="add-on">E-mail</span>
   	  <input rel="tooltip" data-placement="right" title="Digite seu e-mail cadastrado no sistema" style="width:255px;" name="email_login" type="email" class="form_recup" id="email_recup" />
      <br />
      <br />
      <button type="submit" class="btn" id="enviar_recup" onclick="return false;">GERAR NOVA SENHA</button>
      </div>
      <div style="margin-top:10px;" id="resultadoRecup"></div>
      <a href="login.php">Voltar</a>
      <?php endif; ?>
        
        
    </form>
</header>
<!-- header -->

</body>
</html>