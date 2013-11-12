
<?php 

	#CONFIGURAÇÕES

	#Titulo da página
	define("TITLE", "VIDEOS");

	#Nome da tabela no banco
	define("TABLE", "videos");

	#Dados para a listagem
	$listagem = array(
		labels=>array("Nome","Data"),
		tamanho=>array("50%","40%"),
		campos=>array("nome","data")
	);

	#Dados para insert e update
	$insertUpdate = array(
		labels=>array("Nome","Data", "V&iacute;deo (youtube)"),
		nomeCampo=>array("nome","data", "video"),
		tipoCampo=>array("text","date", "text"),
		valoresCampoSelect=>array("val1", "val2", "val3"),
		complementoCampo=>array("style=\"width:350px;\" maxlength=\"40\" required", "style=\"width:350px;\" required", "style=\"width:350px;\" required")
	);

?>


<h1><?php echo TITLE; ?></h1>
<br />
<a href="index.php?secao=pages/<?php echo TABLE; ?>&acao=inserir" role="button" class="btn btn-info">INSERIR VIDEO</a> 
<br />
<br />
<?php 
	if(@$_GET["acao"] == "lista"):
	$sql = mysql_query("SELECT * FROM ".TABLE." ORDER BY ID DESC");
	if(mysql_num_rows($sql) == false):
	echo '<div style="text-align:center;" class="alert alert-info">Nenhum registro encontrado</div>';
	else:
?>
    <table class="table table-hover" style="width:100%;">
		<thead>
			<tr>
				<?php 
				foreach($listagem["labels"] as $chave => $valLabels){
				?>
				<th width="<?php echo $ln->$listagem["tamanho"][$chave]; ?>" style="text-align:left;"><?php echo $valLabels ?></th>
				<?php 
				}
				?>
				<th width="10%" style="text-align:left;">A&ccedil;&atilde;o</th>
			</tr>
		</thead>
		<tbody>
        <?php 
		while($ln = mysql_fetch_object($sql)):
		
		?>
		<tr>
			<?php 
			foreach($listagem["campos"] as $chave => $valLabels){
			?>
			<td>
			<?php
				if($listagem["campos"][$chave] == "data"){
					echo inverteData($ln->$listagem["campos"][$chave]);
				}else{
					echo $ln->$listagem["campos"][$chave];
				}
			?>
			</td>
			<?php 
			}
			?>
            <td>
				<div class="btn-group">
					<a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">A&ccedil;&atilde;o<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="index.php?secao=pages/<?php echo TABLE; ?>&acao=editar&ID=<?php echo $ln->ID; ?>">Editar</a></li>
						<li><a href="index.php?secao=pages/<?php echo TABLE; ?>&acao=deletar&ID=<?php echo $ln->ID; ?>" onClick="return confirm('Deseja deletar?');">Deletar</a></li>
					</ul>
				</div>
           </td>
		</tr>
        <?php 
		endwhile; 
		?>
		</tbody>
    </table>
<?php 
	endif;
	endif;
?>

<?php 
	if(@$_GET["acao"] == "inserir"): 
?>
<form name="inserir" method="post" action="index.php?secao=pages/<?php echo TABLE; ?>&acao=inserir">
	<?php 
		foreach($insertUpdate["labels"] as $chave => $valLabels){
			echo '<div>'.$valLabels.'</div>'."\n";
			if($insertUpdate["tipoCampo"][$chave] == "select"){
				echo '<select '.$insertUpdate["complementoCampo"][$chave].' name="'.$insertUpdate["nomeCampo"][$chave].'">'."\n";
				echo '<option value="">Selecione</option>'."\n";
				foreach($insertUpdate["valoresCampoSelect"] as $chave => $val){
					echo '<option value="'.$val.'">'.$val.'</option>'."\n";
				}
				echo '</select>'."\n";
			}elseif($insertUpdate["tipoCampo"][$chave] == "textarea"){
				echo '<textarea '.$insertUpdate["complementoCampo"][$chave].' name="'.$insertUpdate["nomeCampo"][$chave].'" ></textarea>'."\n";
			}else{
				echo '<input '.$insertUpdate["complementoCampo"][$chave].' type="'.$insertUpdate["tipoCampo"][$chave].'" name="'.$insertUpdate["nomeCampo"][$chave].'" />'."\n";
			}
		}
	?>
  <br />
  <input type="submit" id="enviar" name="enviar" class="btn btn-primary" value="ENVIAR" />
</form>
<?php 

	if(@$_POST){
	/*	
		#Verifica se o campo é de vídeo, se for limita apenas para envios do youtube
		foreach($insertUpdate["nomeCampo"] as $chave => $val){
			if($val == "video"){
				if(strpos($_POST["video"], "youtube") == false){
					echo '
					<div class="alert alert-block alert-error fade in">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
						Use apenas videos do <strong>Youtube</strong>.
					</div>
					';
					exit;	
				}
			}
		}

		#Verifica se o campo é do tipo imagem
		/*foreach($insertUpdate["nomeCampo"] as $chave => $val){
			if($val == "file"){
				$fotoToSql = enviaFoto($fotoForm, TABLE, "resize", $posicao="", "500", $larguraFixa="", $alturaFixa="");
			}
		}

		#Moonta os campos para o SQL
		$i = 0;
		$count = count($insertUpdate["nomeCampo"]);
		foreach($insertUpdate["nomeCampo"] as $chave => $val){
			#Função para retirar a virgula do ultimo registro
			$i++;
			if($i < $count){
				if($val != "file"){
					$camposSql .= "$val".", ";
				}
			}else{
				if($val != "file"){
					$camposSql .= "$val";
				}
			}
		}

		#Monta os valores dos campos para o SQL
		$i = 0;
		$count = count($insertUpdate["nomeCampo"]);
		foreach($insertUpdate["nomeCampo"] as $chave => $val){
			#Função para retirar a virgula do ultimo registro
			$i++;
			if($i < $count){
				#Se o POST for de um campo de vídeo, cria uma expressão regular para pegar o GET V do link do vídeo
				if($val == "video"){
					#Pega apenas o ID do vídeo
					parse_str(parse_url($_POST["$val"], PHP_URL_QUERY));
					$valoresCamposSql .= "'".$v."'";
				}else{
					$valoresCamposSql .= "'".$_POST["$val"]."'".", ";
				}
			}else{
				#Se o POST for de um campo de vídeo, cria uma expressão regular para pegar o GET V do link do vídeo
				if($val == "video"){
					#Pega apenas o ID do vídeo
					parse_str(parse_url($_POST["$val"], PHP_URL_QUERY));
					$valoresCamposSql .= "'".$v."'";
				}elseif($val != "file"){
					$valoresCamposSql .= "'".$_POST["$val"]."'";
				}
			}
		}

		#Insere os dados no banco
		$runSql = insert(array($camposSql), array($valoresCamposSql), TABLE, true);
		*/

		extract($_POST);

		if(strpos($_POST["video"], "youtube") == false){
				echo '
				<div class="alert alert-block alert-error fade in">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					Use apenas videos do <strong>Youtube</strong>.
				</div>
			';
			exit;	
		}

		parse_str(parse_url($video, PHP_URL_QUERY));		

		$runSql = insert(array("nome", "data", "video"), array($nome, $data, $v), TABLE, true);

		if($runSql == true){
			echo '
			<div class="alert alert-success fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Registro cadastrado com sucesso. <a href="index.php?secao=pages/'.TABLE.'&acao=inserir"><strong>Inserir outro</strong></a> ou <a href="index.php?secao=pages/'.TABLE.'&acao=lista"><strong>Listar todos</strong></a>
			</div>
			';
		}
		
	}
	
	endif; //End GET inserir
		
?>

<?php 
	if(@$_GET["acao"] == "editar"):
	$ln = mysql_fetch_object(mysql_query("SELECT * FROM ".TABLE." WHERE ID = '".$_GET["ID"]."'")) ;
?>
<form name="inserir" method="post" action="index.php?secao=pages/<?php echo TABLE; ?>&acao=editar&ID=<?php echo $_GET["ID"]; ?>" enctype="multipart/form-data">
	<?php 
		foreach($insertUpdate["labels"] as $chave => $valLabels){
	?>
	<div><?php echo $valLabels; ?></div>
	<input <?php if($insertUpdate["tipoCampo"][$chave] != "file"): echo $insertUpdate["complementoCampo"][$chave]; endif; ?> type="<?php echo $insertUpdate["tipoCampo"][$chave]; ?>" name="<?php echo $insertUpdate["nomeCampo"][$chave]; ?>" value="<?php if($insertUpdate["nomeCampo"][$chave] == "video"): echo 'http://www.youtube.com/watch?v='.$ln->$insertUpdate["nomeCampo"][$chave]; else: echo $ln->$insertUpdate["nomeCampo"][$chave]; endif; ?>" />
	<?php 
	if($insertUpdate["tipoCampo"][$chave] == "file"){
		echo '<input type="hidden" name="'.$insertUpdate["nomeCampo"][$chave].'Atual" value="'.$ln->$insertUpdate["nomeCampo"][$chave].'" />';
	}
	?>
	<?php
	} //Endforeach
	?>
  <br />
  <input type="submit" id="enviar" name="enviar" class="btn btn-primary" value="ENVIAR" />
</form>
<?php 

	if(@$_POST){
		
		extract($_POST);
		
		if(strpos($video, "youtube") == false){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
				Use apenas videos do <strong>Youtube</strong>.
			</div>
			';
			exit;
		}
		
		parse_str(parse_url($video, PHP_URL_QUERY));
		
		$update = update(array("nome", "video", "data"), array($nome, $v, $data), TABLE, "WHERE ID = ".$_GET["ID"]."");
			
			if($update == true){
				echo '
				<div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				Registro atualizado com sucesso. <a href="index.php?secao=pages/'.TABLE.'&acao=lista"><strong>Listar todos</strong></a>
				</div>
				';
			}
		
	}
	
	endif; 
		
?>

<?php 
	if($_GET["acao"] == "deletar"){
		delete(TABLE, "WHERE ID = '".$_GET["ID"]."'");
		header("Location: index.php?secao=pages/".TABLE."&acao=lista");
	}
?>

