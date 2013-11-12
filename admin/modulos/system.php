<ul class="breadcrumb">
  <li><a href="index.php?secao=modulos/home">Home</a> <span class="divider">/</span></li>
  <li class="active">Configura&ccedil;&otilde;es do sistema</li>
</ul>
<h1>SISTEMA</h1>
<br />

<form name="formSystem" method="post" action="index.php?secao=modulos/system">
   <div class="tab-pane active" id="geral">
  	<div>Titulo</div>
    <div><input required style="width:300px;" class="forms" type="text" name="title" id="title" value="<?php echo uniqSelect("system", "title"); ?>" /></div>
    <div>Descri&ccedil;&atilde;o</div>
    <div><input style="width:300px;" class="forms" type="text" name="description" id="description" value="<?php echo uniqSelect("system", "description"); ?>" /></div>
    <div>Palavras Chave (<em>Coloque valores separados por virgula</em>)</div>
    <div><input style="width:300px;" class="forms" type="text" name="tags" id="tags" value="<?php echo uniqSelect("system", "tags"); ?>" /></div>
    <div>E-mail (E-mail que ira receber as mensagens enviadas pelos formularios do site)</div>
    <div><input required style="width:300px;" class="forms" type="email" name="emailGeral" id="emailGeral" value="<?php echo uniqSelect("system", "emailGeral"); ?>" /></div>
    <div>Url do site</div>
    <div><input required style="width:300px;" class="forms" type="text" name="siteUrl" id="siteUrl" value="http://<?php echo $_SERVER['SERVER_NAME']; ?>/" readonly /></div>
    <div>Telefone</div>
    <div><input onkeypress="mascara(this, Telefone);" maxlength="14" required style="width:300px;" class="forms" type="tel" name="telefone" id="telefone" value="<?php echo uniqSelect("system", "telefone"); ?>" /></div>
    <div>Codigo do Google Analytics</div>
    <div>
    <textarea name="codigoAnalytics" id="codigoAnalytics" style="width:300px; height:100px;"><?php echo uniqSelect("system", "codigoAnalytics"); ?></textarea>
    </div>
    </div>
  <input type="submit" id="enviar" name="enviar" class="btn btn-primary" value="ATUALIZAR DADOS" />
</div>
</form>


<?php 

	if(@$_POST):
	
	extract($_POST);
	
	$atualiza = update(
	array("codigoAnalytics", "title", "description", "tags", "siteUrl", "emailGeral", "telefone"), 
	array("$codigoAnalytics", "$title", "$description", "$tags", "$siteUrl", "$emailGeral", "$telefone"),
	"system", "WHERE ID = 1"
	);
	
	if($atualiza){
		echo '
		<div class="alert alert-success fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
    	Dados do sistema atualziados com sucesso. <a href="index.php?secao=modulos/system"><strong>Regarregar p&aacute;gina</strong></a>
		</div>
		';
    header("Refresh: 2; url=index.php?secao=modulos/system");
	}
	
	endif;
?>