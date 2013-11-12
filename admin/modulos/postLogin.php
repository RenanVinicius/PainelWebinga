<?php 
	session_start();
	include_once("../../config/conexao.php");
	include_once("../../config/funcoesGerais.php");
	
	if($_POST["email_login"] == false){
		echo '
		<div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
    	Por favor, preencha seu e-mail.
		</div>
		';
		echo '<script type="text/javascript">document.formLogin.email_login.focus();</script>';
		exit;
	}
	
	if(validaEmail($_POST["email_login"]) == false){
		echo '
		<div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
    	Preencha um e-mail v&aacute;lido.
		</div>
		';
		echo '<script type="text/javascript">document.formLogin.email_login.focus();</script>';
		exit;
	}
	
	if($_POST["senha_login"] == false){
		echo '
		<div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
    	Por favor, preencha a senha.
		</div>
		';
		echo '<script type="text/javascript">document.formLogin.senha_login.focus();</script>';
		exit;
	}
	
	$email_form = anti_inject($_POST["email_login"]);
	$senha_form = anti_inject(md5($_POST["senha_login"]));
	

	$consulta = @mysql_query("SELECT * FROM admin WHERE email = '$email_form' AND senha = '$senha_form'");


	if(@mysql_num_rows($consulta) == false){
		echo '
		<div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
    	E-mail ou senha incorretos.
		</div>
		';
		echo '<script type="text/javascript">document.formLogin.reset();</script>';
		exit;
	}else{
		$ln = mysql_fetch_object($consulta);
		if($ln->email == $email_form and $ln->senha == $senha_form){
			@$_SESSION["email_admin"] = $ln->email;
			@$_SESSION["senha_admin"] = $ln->senha;
			echo '<script type="text/javascript">location.href="index.php";</script>';
		}else{
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
    		E-mail ou senha incorretos.
			</div>
			';
			echo '<script type="text/javascript">document.formLogin.reset();</script>';
			exit;
		}
	}
	
?>