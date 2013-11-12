<div id="atualizacao">
<?php 
	
	//Conecta ao mysql remoto
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');

	//$ConnectMysql = mysql_connect("", "", "") or die (mysql_error());
	//$SelectDBMysql = mysql_select_db("") or die (mysql_error());
	//A linha abaixo é a mesma coisa do de cima, porem criptografado.
	eval(stripslashes(base64_decode('JENvbm5lY3RNeXNxbCA9IG15c3FsX2Nvbm5lY3QoIndlYmluLmdhIiwgIndlYmluX3VwZGF0ZSIsICJXM2Ixbmc0I1VwZGF0ZSIpIG9yIGRpZSAobXlzcWxfZXJyb3IoKSk7DSRTZWxlY3REQk15c3FsID0gbXlzcWxfc2VsZWN0X2RiKCJ3ZWJpbl91cGRhdGUiKSBvciBkaWUgKG15c3FsX2Vycm9yKCkpOw==')));

	//Verifica se foi conectado ao Mysql remoto
	if($ConnectMysql == false or $SelectDBMysql == false){
		echo 'Não foi possivel conectar ao mysql remoto';
	}

	//Pega a útlma versão remota disponível
	$versionRemote = mysql_fetch_object(mysql_query("SELECT * FROM remote_update_sistema ORDER BY ID DESC", $ConnectMysql));

	//Pega versão atual
	$versionCurrent  = mysql_fetch_object(mysql_query("SELECT * FROM update_sistema ORDER BY ID DESC", $Connect));

	if(@$_GET["acao"] == "verificar"):

	//Compara as versões
	if(str_replace(".", "", $versionRemote->lastVersion) > str_replace(".", "", $versionCurrent->lastVersion)){
		echo '
		<div class="alert alert-info">
			<br />
  			<h1>Nova versão <strong>'.$versionRemote->lastVersion.'</strong> disponível desde '.date('d/m/Y H:i:s', strtotime($versionRemote->dataUpdate)).'</h1>
  			<br />
  			<br />
  			<a href="?secao=upVersion/up&acao=atualizar" class="btn">INSTALAR ATUALIZAÇÃO</a> | <a href="?secao=upVersion/up&acao=newnotes" class="btn">Ver o que será atualizado</a>
  			<br />
  			<br />
		</div>
		'."\n";
	}else{
		echo '
		<div class="alert alert-block">
			<br />
  			<h1>Nenhuma atualização disponível!</v1>
  			<br />
  			<br />
  			<div>Versão atual: <strong>'.$versionCurrent->lastVersion.'</strong></div>
  			<div>Última atualização em: <STRONG>'.date('d/m/Y H:i:s', strtotime($versionCurrent->dataUpdate)).'</div>
  			<br />
  			<br />
  			<a href="?secao=upVersion/up&acao=currentnotes" class="btn">Notas de atualizações</a>
  			<br />
  			<br />
		</div>
		'."\n";
	}

	endif;

	if(@$_GET["acao"] == "atualizar"):
		
		//Verifica se ainda não foi atualizado
		if(str_replace(".", "", $versionRemote->lastVersion) > str_replace(".", "", $versionCurrent->lastVersion)){

		//Baixa o arquivo do ftp
		$ch = curl_init();
		$download = 'http://update.webin.ga/'.$versionRemote->lastVersion.'.zip';
		curl_setopt($ch, CURLOPT_URL, $download);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec ($ch);

		curl_close ($ch);

		$destino = './'.$versionRemote->lastVersion.'.zip';
		$arquivo = fopen($destino, "w+");
		fputs($arquivo, $data);

		fclose($arquivo);

		//Desconpacta o arquivo
		$zip = new ZipArchive;
		if ($zip->open('./'.$versionRemote->lastVersion.'.zip') == true) {
		    $zip->extractTo("./");
		    $zip->close();
		}

		//Aapaga o arquivo baixado
		unlink('./'.$versionRemote->lastVersion.'.zip');

		//Atualiza no banco de dados
		mysql_query("INSERT INTO update_sistema (lastVersion, dataUpdate, notes) VALUES ('".$versionRemote->lastVersion."', '".$versionRemote->dataUpdate."', '".base64_encode($versionRemote->notes)."')", $Connect) or die (mysql_error());
		
		header("Location: ?secao=upVersion/up&acao=atualizado");

		}else{
			header("Location: ?secao=upVersion/up&acao=verificar");
		}

	endif;

	if(@$_GET["acao"] == "newnotes" and str_replace(".", "", $versionRemote->lastVersion) > str_replace(".", "", $versionCurrent->lastVersion)):
		echo '<div><h1>Notas de atualizações para a versão: <strong>'.$versionRemote->lastVersion.'</strong></h1></div><br />';
		echo $versionRemote->notes;
	endif;

	if(@$_GET["acao"] == "currentnotes"):
		echo '<div><h1>Notas da versão atual: <strong>'.$versionCurrent->lastVersion.'</strong></h1></div><br />';
		echo base64_decode($versionCurrent->notes);
	endif;

	if(@$_GET["acao"] == "atualizado"):
		echo '<div><h1>Seu sistema foi atualizado para a versão: <strong>'.$versionRemote->lastVersion.'</strong></h1></div><br />';
	endif;

?>
</div>

<?php


?>
