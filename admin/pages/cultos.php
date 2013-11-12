
<?php 

	#CONFIGURAÇÕES

	#Titulo da página
	define("TITLE", "CULTOS");

	#Nome da tabela no banco
	define("TABLE", "cultos");

	#Dados para a listagem
	$listagem = array(
		labels=>array("Dia","Nome", "Hora", "Destaque"),
		tamanho=>array("20%","20%", "20%", "20%"),
		campos=>array("dia","nome", "hora", "destaque")
	);

	#Dados para insert e update
	$insertUpdate = array(
		labels=>array("Dia", "Nome", "Hora"),
		nomeCampo=>array("dia", "nome", "hora"),
		tipoCampo=>array("select", "text", "text"),
		valoresCampoSelect=>array("Domingo", "Segunda", "Terca", "Quarta", "Quinta", "Sexta", "Sabado"),
		complementoCampo=>array(
			"style=\"width:350px;\" required",
			"style=\"width:350px;\" maxlength=\"15\" required", 
			"style=\"width:350px;\" required onkeypress=\"mascara(this, Hora);\"",
			)
	);

?>


<h1><?php echo TITLE; ?></h1>
<br />
<a href="index.php?secao=pages/<?php echo TABLE; ?>&acao=inserir" role="button" class="btn btn-info">INSERIR</a> 
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
				}elseif($listagem["campos"][$chave] == "destaque"){
					if($ln->destaque == "1"){
						echo 'Sim';
					}else{
						echo 'N&atilde;o';
					}
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
	<div>Marque para esse registro aparecer em destaque na p&aacute;gina inicial.</div>
	<label><input type="checkbox" name="destaque" value="1" /><span style="padding-left:5px;">Destaque</span></label>
	<br />
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

		extract($_POST);

		$runSql = insert(array("dia", "nome", "hora", "destaque"), array($dia, $nome, $hora, $destaque), TABLE);

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
	<div>Marque para esse registro aparecer em destaque na p&aacute;gina inicial.</div>
	<label><input type="checkbox" name="destaque" value="1" <?php if($ln->destaque == "1"): echo 'checked'; endif; ?> /><span style="padding-left:5px;">Destaque</span></label>
	<br />
	<?php 
		foreach($insertUpdate["labels"] as $chave => $valLabels){
			echo '<div>'.$valLabels.'</div>'."\n";
			if($insertUpdate["tipoCampo"][$chave] == "select"){
				echo '<select '.$insertUpdate["complementoCampo"][$chave].' name="'.$insertUpdate["nomeCampo"][$chave].'">'."\n";
				echo '<option value="">Selecione</option>'."\n";
				foreach($insertUpdate["valoresCampoSelect"] as $chave => $val){
					if($val == $ln->dia){
						echo '<option value="'.$val.'" selected>'.$val.'</option>'."\n";
					}else{
						echo '<option value="'.$val.'">'.$val.'</option>'."\n";
					}
				}
				echo '</select>'."\n";
			}elseif($insertUpdate["tipoCampo"][$chave] == "textarea"){
				echo '<textarea '.$insertUpdate["complementoCampo"][$chave].' name="'.$insertUpdate["nomeCampo"][$chave].'">'.$ln->$insertUpdate["nomeCampo"][$chave].'</textarea>'."\n";
			}else{
				echo '<input '.$insertUpdate["complementoCampo"][$chave].' type="'.$insertUpdate["tipoCampo"][$chave].'" name="'.$insertUpdate["nomeCampo"][$chave].'" value="'.$ln->$insertUpdate["nomeCampo"][$chave].'" />'."\n";
			}
		}
	?>

  <br />
  <input type="submit" id="enviar" name="enviar" class="btn btn-primary" value="ENVIAR" />
</form>
<?php 

	if(@$_POST){
		
		extract($_POST);
		
		$update = update(array("dia", "nome", "hora", "destaque"), array($dia, $nome, $hora, $destaque), TABLE, "WHERE ID = ".$_GET["ID"]."");
			
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

