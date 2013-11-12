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
    
</header>

<div class="navbar">
	<div class="navbar-inner">
		<div class="nav-collapse collapse">
			<ul class="nav pull-left">
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">IGREJA <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="index.php?secao=pages/textos&tipo=historia&foto=sim">Hist&oacute;ria</a></li>
						<li><a href="index.php?secao=pages/textos&tipo=visao&foto=sim">Vis&atilde;o</a></li>
						<li><a href="index.php?secao=pages/textos&tipo=missao&foto=sim">Miss&atilde;o</a></li>
						<li><a href="index.php?secao=pages/textos&tipo=valores&foto=sim">Valores</a></li>
						<li class="divider"></li>
						<li><a href="index.php?secao=pages/fotos_igreja&acao=lista">Linha do tempo</a></li>
					</ul>
				</li>
				<li class="divider-vertical"></li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">MULTIM&Iacute;DIA <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="index.php?secao=pages/videos&acao=lista">V&iacute;deos</a></li>
						<li><a href="index.php?secao=pages/pregacoes&acao=lista">Prega&ccedil;&otilde;es</a></li>
					</ul>
				</li>
				<li class="divider-vertical"></li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">PROGRAMA&Ccedil;&Atilde;O <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="index.php?secao=pages/reunioes&acao=lista">Reuni&otilde;es</a></li>
						<li><a href="index.php?secao=pages/cursos&acao=lista">Cursos</a></li>
						<li><a href="index.php?secao=pages/eventos&acao=lista">Eventos</a></li>
						<li><a href="index.php?secao=pages/cultos&acao=lista">Cultos</a></li>
					</ul>
				</li>
				<li><a href="index.php?secao=pages/ministerios&acao=lista">MINIST&Eacute;RIOS</a></li>
				<li><a href="index.php?secao=pages/celulas&acao=lista">C&Eacute;LULAS</a></li>
				<li><a href="index.php?secao=pages/noticias&acao=lista">NOT&Iacute;CIAS</a></li>
				<li><a href="index.php?secao=pages/enquete">ENQUETE</a></li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">SLIDER <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="index.php?secao=pages/slider&acao=lista">Slider principal</a></li>
						<li><a href="index.php?secao=pages/slider_home&acao=lista">Slider secund&aacute;rio</a></li>
					</ul>
				</li>
				<li><a href="index.php?secao=pages/galeria&acao=lista">GALERIA DE FOTOS</a></li>
			</ul>
		</div>
	</div>
</div>

<div id="content">
<?php 
	$pg = anti_inject($_GET["secao"]);
	if(file_exists("$pg.php") == true){
		@include_once("$pg.php");
	}elseif($pg == false){
		//header("Location: index.php?secao=pages/home");
	}else{
		//header("Location: index.php?secao=pages/home");
	}
?>
</div>

</div>

</body>
</html>