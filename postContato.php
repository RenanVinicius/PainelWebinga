<?php 

	include_once("config/conexao.php");
	include_once("config/funcoesGerais.php");
	include_once("config/sendMail.php");

	extract($_POST);

	//Configurações do envio
	$nomeForm = "formContato";
	
	if(strip_tags($nomeC) == false){
		echo 'Preencha o nome.';
		echo '<script type="text/javascript">document.formContato.nomeC.focus();</script>';
		exit;
	}

	if(strip_tags($emailC) == false){
		echo 'Preencha o e-mail.';
		echo '<script type="text/javascript">document.formContato.emailC.focus();</script>';
		exit;
	}

	if(validaEmail($emailC) == false){
		echo 'Preencha um e-mail v&aacute;lido.';
		echo '<script type="text/javascript">document.formContato.emailC.focus();</script>';
		exit;
	}
	
	if(strip_tags($telefoneC) == false){
		echo 'Preencha o seu telefone.';
		echo '<script type="text/javascript">document.formContato.telefoneC.focus();</script>';
		exit;
	}

	if(strlen($telefoneC) < 14){
		echo 'Preencha um telefone v&aacute;lido.';
		echo '<script type="text/javascript">document.formContato.telefoneC.focus();</script>';
		exit;
	}

	if(strlen($assuntoC) == false){
		echo 'Preencha o assunto.';
		echo '<script type="text/javascript">document.formContato.assuntoC.focus();</script>';
		exit;
	}

	if(strip_tags($msgC) == false){
		echo 'Preencha a mensagem.';
		echo '<script type="text/javascript">document.formContato.msgC.focus();</script>';
		exit;
	}

	
	$nome = strip_tags(utf8_decode($nomeC));
	$email = strip_tags(utf8_decode($emailC));
	$telefone = strip_tags(utf8_decode($telefoneC));
	$assunto = strip_tags(utf8_decode($assuntoC));
	$mensagem = nl2br(strip_tags(utf8_decode($msgC)));

	$assunto_email = 'Contato recebido pelo site - Igreja Batista Siao';
	$msg_email  = '
	<div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666;">
	<div align="left"><strong>Resposta para:</strong> '.$email.'</div>
	<br />
	<div align="left"><strong>Nome:</strong> '.$nome.'</div>
	<div align="left"><strong>E-mail:</strong> '.$email.'</div>
	<div align="left"><strong>Telefone:</strong> '.$telefone.'</div>
	<div align="left"><strong>Assunto:</strong> '.$assunto.'</div>
	<div align="left"><strong>Mensagem:</strong> '.$mensagem.'</div>
	</div>
	';
	require_once('PHPMailer/class.phpmailer.php');
	if(sendMail("Igreja Batista Siao", data_sistem_sql("emailGeral"), $nome, $email, $assunto_email, $msg_email)){
	echo '
		Enviado com sucesso.
		<script type="text/javascript">
		document.formContato.reset();
		</script>
	';
	}else{
		echo '
		Erro ao enviar.
		<script type="text/javascript">
		document.formContato.reset();
		</script>';

	}	

	

?>