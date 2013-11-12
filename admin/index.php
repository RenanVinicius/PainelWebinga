<?php 

	session_start();
	ob_start();
	
	include_once("../config/conexao.php");
	include_once("../config/funcoesGerais.php");
	include_once("../config/urlAmigavel.php");
	include_once("modulos/funcoesAdmin.php");
	
	if($AuthAdmin->MostraResultado() == false){
		unset($_SESSION["email_admin"], $_SESSION["senha_admin"]);
		header("Location: login.php");
	}
	
	@date_default_timezone_set('America/Sao_Paulo');

?>
<!DOCTYPE html>
<html lang="pt">
<head>

<!-- Meta -->
<meta name="author" content="Webinga - www.webinga.com.br" />
<meta charset="UTF-8" />

<!-- Title -->
<title><?php print_r(TITULO.' - '.VERSAO); ?></title>

<!-- Css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!-- Font -->
<link href="http://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css" />

<!-- Js -->
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-tab.js"></script>
<script src="js/scripts.js"></script>
<script src="ckeditor/ckeditor.js"></script>


</head>
<body>

<div class="container">

<header>
    <div class="logo"><a href="index.php"></a></div>

    <div class="btn-group" id="button-sair"><a class="btn btn-danger" href="index.php?secao=modulos/sair">Sair</a></div>
    
    <div class="btn-group" id="button-administracao">
        <button class="btn dropdown-toggle" data-toggle="dropdown">Administra&ccedil;&atilde;o <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="index.php?secao=modulos/admin&acao=lista">Usu&aacute;rios</a></li>
            <li><a href="index.php?secao=modulos/system">Configura&ccedil;&otilde;es</a></li>
            <li class="divider"></li>
            <li><a href="../" target="_blank">Ir para o site</a></li>
        </ul>
    </div>

    <div class="btn-group" id="button-update"><a class="btn btn-info" href="?secao=upVersion/up&acao=verificar">Verificar Atualizações</a></div>
    
</header>

<?php include_once("menu.php"); ?>

<div id="content">
<?php 
	$pg = anti_inject($_GET["secao"]);
	if(file_exists("$pg.php") == true){
		@include_once("$pg.php");
	}elseif($pg == false){
		header("Location: index.php?secao=pages/home");
	}else{
		header("Location: index.php?secao=pages/home");
	}
?>
</div>

</div>

</body>
</html>