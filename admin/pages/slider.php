
<?php 

	#CONFIGURAÇÕES

	#Titulo da página
	define("TITLE", "SLIDER PRINCIPAL");

	#Nome da tabela no banco
	define("TABLE", "slider");


?>
<h1><?php echo TITLE; ?></h1>

<?php 
	if(@$_GET["acao"] == "lista"):
	$sql = mysql_query("SELECT * FROM ".TABLE." ORDER BY ID DESC");
	if(mysql_num_rows($sql) == false):
	echo '
	<br />
     <a style="margin-top:5px;" href="index.php?secao=pages/'.TABLE.'&acao=inserir" role="button" class="btn btn-info">INSERIR FOTOS</a>
    <br />
    <br />	
	<div style="text-align:center;" class="alert alert-info">Nenhuma foto cadastrada</div>';
	else:
?>
    <br />
     <a style="margin-top:5px;" href="index.php?secao=pages/<?php echo TABLE; ?>&acao=inserir" role="button" class="btn btn-info">INSERIR FOTOS</a> <br />
    <br />
    <?php 
	while($ln = mysql_fetch_object($sql)):
	?>
    <div style="float:left; width:100px; height:130px; text-align:center; margin-right:30px; margin-bottom:10px;">
    	<img src="../thumb.php?tipo=nor&amp;img=uploads/<?php echo TABLE; ?>/<?php echo $ln->foto; ?>&amp;w=100&amp;h=80" width="100" height="80"  alt="" />
        <br />
        <a style="margin-top:5px;" href="index.php?secao=pages/<?php echo TABLE; ?>&acao=deletar&fotoID=<?php echo $ln->ID; ?>&file=<?php echo $ln->foto; ?>" class="btn btn-danger" onClick="return confirm('Deseja deletar?');">Deletar</a>
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
<br />
<form name="inserir" method="post" action="index.php?secao=pages/<?php echo TABLE; ?>&acao=inserir" enctype="multipart/form-data">
	<div>Foto - 650x300</div>
    <div>
    	<input type="file" name="foto" id="foto" required>
    </div>
    <br />
    <div><input type="submit" id="enviar" name="enviar" class="btn btn-primary" value="ENVIAR" /></div>
</form>
<?php 
	
	if(@$_POST){
		
		$foto = enviaFoto($_FILES["foto"], TABLE, "crop", "center", "", "650", "300");

		insert(array("foto"), array($foto), "slider");
				
		echo '
		<div class="alert alert-success fade in">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		Fotos enviadas com sucesso. <a href="index.php?secao=pages/'.TABLE.'&acao=inserir"><strong>Inserir mais</strong></a> ou <a href="index.php?secao=pages/'.TABLE.'&acao=lista"><strong>Listar todas</strong></a>
		</div>
		';
		
	}
	
	endif;
?>

<?php 
	if($_GET["acao"] == "deletar"){
		unlink("../uploads/".TABLE."/".$_GET["file"]."");
		delete(TABLE, "WHERE ID = '".$_GET["fotoID"]."'");
		header("Location: index.php?secao=pages/".TABLE."&acao=lista");
	}
?>
