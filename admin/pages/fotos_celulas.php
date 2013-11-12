
<?php 

	$sqlCelula = @mysql_fetch_object(mysql_query("SELECT * FROM celulas WHERE ID = '".$_GET["celulaID"]."'"));

	#Titulo da página
	define("TITLE", "FOTOS - ".strtoupper($sqlCelula->titulo)."");

	#Nome da tabela no banco
	define("TABLE", "fotos_celulas");


?>
<h1><?php echo TITLE; ?></h1>

<br />

<?php 
	if(@$_GET["acao"] == "lista"):
	$sql = mysql_query("SELECT * FROM ".TABLE." WHERE celulaID = ".$_GET["celulaID"]." ORDER BY ID DESC") or die (mysql_error());
	if(mysql_num_rows($sql) == false):
	echo '
	<br />
     <a style="margin-top:5px;" href="index.php?secao=pages/'.TABLE.'&acao=inserir&celulaID='.$_GET["celulaID"].'" role="button" class="btn btn-info">INSERIR FOTOS</a>
    <br />
    <br />	
	<div style="text-align:center;" class="alert alert-info">Nenhuma foto cadastrada</div>';
	else:
?>
    <br />
     <a style="margin-top:5px;" href="index.php?secao=pages/<?php echo TABLE; ?>&acao=inserir&celulaID=<?php echo $_GET["celulaID"]; ?>" role="button" class="btn btn-info">INSERIR FOTOS</a> <br />
    <br />
    <?php 
	while($ln = mysql_fetch_object($sql)):
	?>
    <div style="float:left; width:100px; height:130px; text-align:center; margin-right:30px; margin-bottom:10px;">
    	<img src="../thumb.php?tipo=nor&amp;img=uploads/<?php echo TABLE; ?>/<?php echo $ln->foto; ?>&amp;w=100&amp;h=80" width="100" height="80"  alt="" />
        <br />
        <a style="margin-top:5px;" href="index.php?secao=pages/<?php echo TABLE; ?>&acao=deletar&fotoID=<?php echo $ln->ID; ?>&celulaID=<?php echo $_GET["celulaID"]; ?>&file=<?php echo $ln->foto; ?>" class="btn btn-danger" onClick="return confirm('Deseja deletar?');">Deletar</a>
    </div>   
<?php 
	endwhile;
?>    
<div style="clear:both;"></div>
<?php 
	endif;
	endif;
?>

<?php 
	if(@$_GET["acao"] == "inserir"):
?>
<form name="inserir" method="post" action="index.php?secao=pages/<?php echo TABLE; ?>&acao=inserir&celulaID=<?php echo $_GET["celulaID"]; ?>" enctype="multipart/form-data">
	<div>Foto 01</div>
    <div>
    	Legenda: <input type="text" name="legenda1">
    	<br />
    	<input type="file" name="foto1" id="foto1" required>
    </div>
    <br />

    <div>Foto 02</div>
    <div>
    	Legenda: <input type="text" name="legenda2">
    	<br />
    	<input type="file" name="foto2" id="foto2">
    </div>
    <br />

    <div>Foto 03</div>
    <div>
    	Legenda: <input type="text" name="legenda3">
    	<br />
    	<input type="file" name="foto3" id="foto3">
    </div>
    <br />

   	<div>Foto 04</div>
    <div>
    	Legenda: <input type="text" name="legenda4">
    	<br />
    	<input type="file" name="foto4" id="foto4">
    </div>
    <br />
    <div><input type="submit" id="enviar" name="enviar" class="btn btn-primary" value="ENVIAR" /></div>
</form>
<?php 
	
	if(@$_POST){
		
		extract($_POST);

		if(@$_FILES["foto1"]["name"] == true){
			$foto1 = enviaFoto($_FILES["foto1"], TABLE, "resize", $posicao="", "600", $larguraFixa="", $alturaFixa="");
			insert(array("legenda", "foto", "celulaID"), array($legenda1, $foto1, $_GET["celulaID"]), TABLE);
		}
		
		if(@$_FILES["foto2"]["name"] == true){
			$foto2 = enviaFoto($_FILES["foto2"], TABLE, "resize", $posicao="", "600", $larguraFixa="", $alturaFixa="");
			insert(array("legenda", "foto", "celulaID"), array($legenda2, $foto2, $_GET["celulaID"]), TABLE);
		}
		
		if(@$_FILES["foto3"]["name"] == true){
			$foto3 = enviaFoto($_FILES["foto3"], TABLE, "resize", $posicao="", "600", $larguraFixa="", $alturaFixa="");
			insert(array("legenda", "foto", "celulaID"), array($legenda3, $foto3, $_GET["celulaID"]), TABLE);
		}
		
		if(@$_FILES["foto4"]["name"] == true){
			$foto4 = enviaFoto($_FILES["foto4"], TABLE, "resize", $posicao="", "600", $larguraFixa="", $alturaFixa="");
			insert(array("legenda", "foto", "celulaID"), array($legenda4, $foto4, $_GET["celulaID"]), TABLE);
		}
		
			echo '
			<div class="alert alert-success fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Fotos enviadas com sucesso. <a href="index.php?secao=pages/'.TABLE.'&acao=inserir&celulaID='.$_GET["celulaID"].'"><strong>Inserir mais</strong></a> ou <a href="index.php?secao=pages/'.TABLE.'&acao=lista&celulaID='.$_GET["celulaID"].'"><strong>Listar todas</strong></a>
			</div>
			';
		
	}
	
	endif;
?>

<?php 
	if($_GET["acao"] == "deletar"){
		unlink("../uploads/".TABLE."/".$_GET["file"]."");
		delete(TABLE, "WHERE ID = '".$_GET["fotoID"]."'");
		header("Location: index.php?secao=pages/".TABLE."&acao=lista&celulaID=".$_GET["celulaID"]."");
	}
?>
