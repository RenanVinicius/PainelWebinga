<h1>EDITAR: <strong><?php echo strtoupper($_GET["tipo"]) ?></strong></h1>
<br />
<?php 
	$texto = mysql_fetch_object(mysql_query("SELECT * FROM textos WHERE tipo = '".$_GET["tipo"]."'"));
?>
<form name="editarTexto" id="editarTexto" method="post" action="index.php?secao=pages/textos&amp;tipo=<?php echo $_GET["tipo"]; ?>&amp;foto=<?php echo $_GET["foto"]; ?>" enctype="multipart/form-data">
 	<textarea class="ckeditor" style="width:98%; height:400px;" class="textarea" name="texto" id="texto"><?php echo $texto->texto; ?></textarea>
 	<?php if(@$_GET["foto"] == "sim"): ?>
 	<br />
 	<br />
 	<?php if(uniqSelect("textos", "foto", "WHERE tipo = '".$_GET["tipo"]."'") == true): ?>
 	<div>Foto atual:</div>
	<img src="../thumb.php?tipo=nor&amp;img=uploads/textos/<?php echo uniqSelect("textos", "foto", "WHERE tipo = '".$_GET["tipo"]."'"); ?>&amp;w=150&amp;h=100" alt="Igreja" />
	<br />
	<br />
	<div><label><input type="checkbox" name="deletarFoto" value="sim" /> Deletar foto atual</label></div>
	<br />
	<?php endif; ?>
 	<div>Foto (Deixe em branco para manter a foto atual)</div>
 	<input type="file" name="foto" id="foto" />
 	<br />
 	<?php endif; ?>
 	<input type="hidden" name="fotoAtual" value="<?php echo $texto->foto; ?>" />
 	<br />
    <input type="submit" name="enviar" value="SALVAR" class="btn btn-primary">
</form>
<?php 
	if(@$_POST){
		
		extract($_POST);
		
		if(@$_GET["foto"] == "sim" and $_FILES["foto"]["name"] == true and $deletarFoto <> "sim"){
			unlink("../uploads/textos/".$_POST["fotoAtual"]);
			$fotoForm = $_FILES["foto"];
			$fotoToSql = enviaFoto($fotoForm, "textos", "resize", $posicao="", "600", $larguraFixa="", $alturaFixa="");
		}else{
			$fotoToSql = $_POST["fotoAtual"];
		}

		if($deletarFoto == "sim" and $_FILES["foto"]["name"] == false){
			unlink("../uploads/textos/".$_POST["fotoAtual"]);
			$fotoToSql = "";
		}

		update(array("texto", "foto"), array(nl2br($texto), $fotoToSql), "textos", "WHERE tipo = '".$_GET["tipo"]."'");
		
		echo '
			<div class="alert alert-success fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Texto atualizado com sucesso. <a href="index.php?secao=pages/textos&tipo='.$_GET["tipo"].'&foto='.$_GET["foto"].'"><strong>Atualizar</strong></a>
			</div>
		';
	}	
?>
