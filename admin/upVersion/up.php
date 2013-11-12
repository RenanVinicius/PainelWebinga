<div id="atualizacao">
<?php 
	
	//$sql = mysql_query("SELECT * FROM update_sistema");

	//Conecta ao mysql remoto
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	$ConnectMysql = mysql_connect("webin.ga", "webin_useratuali", "W3b1ng4#Admin") or die (mysql_error());
	$SelectDBMysql = mysql_select_db("webin_atualizacaoadmin") or die (mysql_error());

	//Verifica se foi conectado ao Mysql remoto
	if($ConnectMysql == false or $SelectDBMysql == false){
		echo 'Não foi possivel conectar ao mysql remoto';
	}

	//Pega a útlma versão remota disponível
	$versionRemote = mysql_fetch_object(mysql_query("SELECT * FROM remote_update_sistema ORDER BY ID DESC", $ConnectMysql));

	//Pega versão atual
	$versionCurrent  = mysql_fetch_object(mysql_query("SELECT * FROM update_sistema", $Connect));

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

	$ch = curl_init();
	$download = 'http://webin.ga/atualizacaoadmin/'.$versionRemote->lastVersion.'.zip';
	curl_setopt($ch, CURLOPT_URL, $download);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec ($ch);

	curl_close ($ch);

	$destino = './'.$versionRemote->lastVersion.'.zip';
	$arquivo = fopen($destino, "w+");
	fputs($arquivo, $data);

	fclose($arquivo);

	endif;

	if(@$_GET["acao"] == "newnotes" and str_replace(".", "", $versionRemote->lastVersion) > str_replace(".", "", $versionCurrent->lastVersion)):
		echo '<div><h1>Notas de atualizações para a versão: <strong>'.$versionRemote->lastVersion.'</strong></h1></div><br />';
		echo $versionRemote->notes;
	endif;

	if(@$_GET["acao"] == "currentnotes"):
		echo '<div><h1>Notas da versão atual: <strong>'.$versionCurrent->lastVersion.'</strong></h1></div><br />';
		echo $versionCurrent->notes;
	endif;


?>
</div>

<?php


?>
