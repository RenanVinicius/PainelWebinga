<?php 
	session_start();
	include_once("../../config/conexao.php");
	include_once("../../config/funcoesGerais.php");
	include_once("../../config/sendMail.php");
	
	if($_POST["email_recup"] == false){
		echo '
		<div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
    	Por favor, preencha seu e-mail.
		</div>
		';
		echo '<script type="text/javascript">document.formLogin.email_recup.focus();</script>';
		exit;
	}
	
	if(validaEmail($_POST["email_recup"]) == false){
		echo '
		<div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
    	Preencha um e-mail v&aacute;lido.
		</div>
		';
		echo '<script type="text/javascript">document.formLogin.email_recup.focus();</script>';
		exit;
	}
	
	$email_form = anti_inject($_POST["email_recup"]);
	

	$consulta = @mysql_query("SELECT * FROM admin WHERE email = '$email_form'");

	if(@mysql_num_rows($consulta) == false){
		echo '
		<div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
    	E-mail n&atilde;o cadastrado.
		</div>
		';
		echo '<script type="text/javascript">document.formLogin.reset();</script>';
		exit;
	}else{
		
		$ln = mysql_fetch_object($consulta);
		
		
		$novaSenha = uniqid(rand(1, 500));
		$hoje = explode("-", date("Y-m-d"));
		$dateExp = date("Y-m-".($hoje[2]+1)."");

		update(
		array("senha", "dataExp"), 
		array((md5($novaSenha)), $dateExp),
		"admin", "WHERE ID = '".$ln->ID."'"
		);
		
		$msgMail = '
		<div style="color:#777; font-family:arial;">
		<div><strong>Segue novos dados de acesso:</strong></div>
		<div>E-mail: <strong>'.$ln->email.'</strong></div>
		<div>Senha: <strong>'.$novaSenha.'</strong></div>
		<div>Link de acesso: <a href="'.data_sistem_sql("siteUrl").'/admin" target="_blank">'.data_sistem_sql("siteUrl").'/admin</a></div>
		<br />
		<br />
		</div>
		';
		
		require_once('../../PHPMailer/class.phpmailer.php');
		sendMail("Webinga", $ln->email, "Webinga", $ln->email, "Nova senha para ".data_sistem_sql("title")."", $msgMail);

		echo '
		<div class="alert alert-success fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
    	Nova senha gerada com sucesso.
		</div>
		';
		
		echo '<script type="text/javascript">document.formLogin.reset();</script>';

		exit;
		
	}
	
?>