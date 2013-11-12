<h1>OUTDOOR</h1>
<br />
<a href="index.php?secao=pages/outdoor&acao=inserir" role="button" class="btn btn-info">INSERIR</a> 
<br />
<br />
<?php 
	if(@$_GET["acao"] == "lista"):
	$sql = mysql_query("SELECT * FROM outdoor ORDER BY ID DESC");
	if(mysql_num_rows($sql) == false):
	echo '<div style="text-align:center;" class="alert alert-info">Nenhum registro encontrado</div>';
	else:
?>
    <table class="table table-hover" style="width:100%;">
		<thead>
			<tr>
				<th width="80%" style="text-align:left;">Nome</th>
				<th width="20%" style="text-align:left;">A&ccedil;&atilde;o</th>
			</tr>
		</thead>
		<tbody>
        <?php 
		while($ln = mysql_fetch_object($sql)):
		?>
		<tr>
			<td><?php echo $ln->nome; ?></td>
            <td>
               <a href="index.php?secao=pages/outdoor&acao=editar&ID=<?php echo $ln->ID; ?>" role="button" class="btn btn-info" data-toggle="modal">Editar</a> 
               <a href="index.php?secao=pages/outdoor&acao=deletar&ID=<?php echo $ln->ID; ?>&foto=<?php echo $ln->foto; ?>" class="btn btn-danger" onClick="return confirm('Deseja deletar?');">Deletar</a>
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
	$nome = (!empty($_POST['nome'])) ? $_POST['nome'] : '';
?>
<form name="inserir" method="post" action="index.php?secao=pages/outdoor&acao=inserir" enctype="multipart/form-data">

	<div>Nome</div>
	<input maxlength="30" required style="width:350px;" type="text" name="nome" id="nome" value="<?php echo $nome; ?>" />

	<div>
		<strong>Foto</strong>
		<br /> 
		Tamanho: <strong>800x250px</strong> ou <strong>28.8x8.8cm</strong>
		<br />
		Formato: <strong>JPG</strong>
	</div>
	<input required style="width:350px;" type="file" name="foto" id="foto" />
	
	<br />

	<div><input type="submit" id="enviar" name="enviar" class="btn btn-primary" value="ENVIAR" /></div>

</form>
<?php 

	if(@$_POST){

	extract($_POST);

	$fotoForm = $_FILES["foto"];

	if(pegaExt($fotoForm["name"]) <> "jpg" and pegaExt($fotoForm["name"]) <> "JPG" and pegaExt($fotoForm["name"]) <> "jpeg" and pegaExt($fotoForm["name"]) <> "JPEG"){
		echo '
		<div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
			Use apenas <strong>JPG</strong>.
		</div>
		';
		exit;
	}

	if(pegaExt($fotoForm["name"]) <> "jpg" and pegaExt($fotoForm["name"]) <> "JPG" and pegaExt($fotoForm["name"]) <> "jpeg" and pegaExt($fotoForm["name"]) <> "JPEG"){
		echo '
		<div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
			Use apenas <strong>JPG</strong>.
		</div>
		';
		exit;
	}

	$foto = enviaFoto($fotoForm, "outdoor", "resize", $posicao="", "800", $larguraFixa="", $alturaFixa="");

	$insere = insert(array("nome", "foto"), array($nome, $foto), "outdoor");
		
	if($insere == true){
		echo '
		<div class="alert alert-success fade in">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		Registro cadastrado com sucesso. <a href="index.php?secao=pages/outdoor&acao=inserir"><strong>Inserir outro</strong></a> ou <a href="index.php?secao=pages/outdoor&acao=lista"><strong>Listar todos</strong></a>
		</div>
		';
	}
		
	}
	
	endif; 
		
?>

<?php 
	if(@$_GET["acao"] == "editar"):
?>
<form name="inserir" method="post" action="index.php?secao=pages/outdoor&acao=editar&ID=<?php echo $_GET["ID"]; ?>" enctype="multipart/form-data">

	<div>Nome</div>
	<input required style="width:350px;" type="text" name="nome" id="nome" value="<?php echo uniqSelect("outdoor", "nome", "WHERE ID = '".$_GET["ID"]."'"); ?>" />

	<div>
		<strong>Foto (Deixe em branco para manter a foto atual)</strong>
		<br /> 
		Tamanho: <strong>800x250px</strong> ou <strong>28.8x8.8cm</strong>
		<br />
		Formato: <strong>JPG</strong>
	</div>
	<input style="width:350px;" type="file" name="foto" id="foto" />


	<input type="hidden" name="fotoAtual" id="fotoAtual" value="<?php echo uniqSelect("outdoor", "foto", "WHERE ID = '".$_GET["ID"]."'"); ?>" />

	<div><input type="submit" id="enviar" name="enviar" class="btn btn-primary" value="ENVIAR" /></div>

</form>
<?php 

	if(@$_POST){
		
	extract($_POST);

	if(@$_FILES["foto"]["name"] == true){
		unlink("../uploads/outdoor/".$_POST["fotoAtual"]."");
		$fotoForm = $_FILES["foto"];
			if(pegaExt($fotoForm["name"]) <> "jpg"){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
				Use apenas <strong>JPG</strong> para a foto grande.
			</div>
			';
			exit;
		}
		$foto = enviaFoto($fotoForm, "outdoor", "resize", $posicao="", "800", $larguraFixa="", $alturaFixa="");
	}else{
		$foto = $_POST["fotoAtual"];
	}
	
	$insere = update(array("nome", "foto"), array($nome, $foto), "outdoor", "WHERE ID = '".$_GET["ID"]."'");
		
	if($insere == true){
		echo '
		<div class="alert alert-success fade in">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		Registro cadastrado com sucesso. <a href="index.php?secao=pages/outdoor&acao=inserir"><strong>Inserir outro</strong></a> ou <a href="index.php?secao=pages/outdoor&acao=lista"><strong>Listar todos</strong></a>
		</div>
		';
	}
		
	}
	
	endif; 
		
?>

<?php 
	if($_GET["acao"] == "deletar"){
		unlink("../uploads/outdoor/".$_GET["foto"]."");
		delete("outdoor", "WHERE ID = '".$_GET["ID"]."'");
		header("Location: index.php?secao=pages/outdoor&acao=lista");
	}
?>
