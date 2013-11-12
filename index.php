<?php 
	
	session_start();
	ob_start();
	
	header('Content-Type: text/html; charset=utf-8');

	include_once("config/conexao.php");
	include_once("config/funcoesGerais.php");
	include_once("config/urlAmigavel.php");
	include_once("config/sendMail.php");
	
	@date_default_timezone_set('America/Sao_Paulo');
	
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

<!-- Meta -->
<meta name="keywords" content="<?php data_sistem("tags"); ?>" />
<meta name="description" content="<?php data_sistem("description"); ?>" />
<meta name="author" content="Renan Vinicius - www.webinga.com.br" />
<meta charset="UTF-8" />

<title><?php data_sistem("title"); ?></title>

<!-- Base -->
<base href="<?php echo root(PASTA_SITE); ?>">


<!-- COMPATIBILIDADE IE ¬¬ -->
<meta http-equiv="X-UA-Compatible" content="IE=08"></meta>
<meta http-equiv="X-UA-Compatible" content="IE=09"></meta>
<meta http-equiv="X-UA-Compatible" content="IE=10"></meta>
<meta http-equiv="X-UA-Compatible" content="IE=11"></meta>

<!-- Google Canonical -->
<link rel="canonical" href="<?php echo root(PASTA_SITE); ?>"/>

<!-- Font -->
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

<!-- Icon -->
<link rel="shortcut icon" type="image/x-icon" href="img/icon.png" />

<!-- Css -->
<link href="css/style.css" rel="stylesheet">

<!-- Jquery -->
<script src="js/jquery.js?v=2.0"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/html5lightbox/html5lightbox.js"></script>
<script src="js/funcoesGerais.js"></script>


<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>
<body>


<?php
	echo uniqSelect("system", "codigoAnalytics");
?>

</body>
</html>