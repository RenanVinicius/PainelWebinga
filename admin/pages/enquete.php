<h1>ENQUETE</h1>
<br />
<a href="index.php?secao=pages/enquete&acao=zerar" role="button" class="btn btn-info">ZERAR VOTOS DA ENQUETE</a> 
<br />
<br />
<form name="enquete" method="post" action="index.php?secao=pages/enquete&acao=atualizar">
	<div>Pergunta:</div>
	<input style="width:600px;" maxlength="100" type="text" name="pergunta" value="<?php echo uniqSelect("enquete", "pergunta", $where = ''); ?>">
	<br />
	<div>Op&ccedil;&atilde;o 01:</div>
	<input required style="width:300px;" maxlength="50" type="text" name="op1" value="<?php echo uniqSelect("enquete", "op1", $where = ''); ?>">
	<div>Op&ccedil;&atilde;o 02:</div>
	<input required style="width:300px;" maxlength="50" type="text" name="op2" value="<?php echo uniqSelect("enquete", "op2", $where = ''); ?>">
	<div>Op&ccedil;&atilde;o 03:</div>
	<input required style="width:300px;" maxlength="50" type="text" name="op3" value="<?php echo uniqSelect("enquete", "op3", $where = ''); ?>">
	<div>Op&ccedil;&atilde;o 04:</div>
	<input required style="width:300px;" maxlength="50" type="text" name="op4" value="<?php echo uniqSelect("enquete", "op4", $where = ''); ?>">
	<div><input class="btn" type="submit" name="atualizar" value="ATUALIZAR DADOS" /></div>
</form>

<br />

<h1>RESULTADOS PARCIAIS DA ENQUETE</h1>
<br />
<div><strong><?php echo uniqSelect("enquete", "pergunta", $where = ''); ?></strong></div>
<br />
<div><?php echo uniqSelect("enquete", "op1", $where = '')." - ".uniqSelect("enquete", "votOp1", $where = '')." votos"." | ".floor(uniqSelect("enquete", "votOp1", $where = '')*100/uniqSelect("enquete", "totalVotos", $where = ''))."%"; ?></div>
<br />
<div><?php echo uniqSelect("enquete", "op2", $where = '')." - ".uniqSelect("enquete", "votOp2", $where = '')." votos"." | ".floor(uniqSelect("enquete", "votOp2", $where = '')*100/uniqSelect("enquete", "totalVotos", $where = ''))."%"; ?></div>
<br />
<div><?php echo uniqSelect("enquete", "op3", $where = '')." - ".uniqSelect("enquete", "votOp3", $where = '')." votos"." | ".floor(uniqSelect("enquete", "votOp3", $where = '')*100/uniqSelect("enquete", "totalVotos", $where = ''))."%"; ?></div>
<br />
<div><?php echo uniqSelect("enquete", "op4", $where = '')." - ".uniqSelect("enquete", "votOp4", $where = '')." votos"." | ".floor(uniqSelect("enquete", "votOp4", $where = '')*100/uniqSelect("enquete", "totalVotos", $where = ''))."%"; ?></div>

<?php 
	
	if(@$_GET["acao"] == "atualizar"){
		extract($_POST);
		update(array("pergunta", "op1", "op2", "op3", "op4"), array($pergunta, $op1, $op2, $op3, $op4), "enquete", "WHERE ID = 1");
		header("Location: index.php?secao=pages/enquete&acao=lista");
	}

	if(@$_GET["acao"] == "zerar"){
		update(array("votOp1", "votOp2", "votOp3", "votOp4", "totalVotos"), array("0", "0", "0", "0", "0"), "enquete", "WHERE ID = 1");
		header("Location: index.php?secao=pages/enquete&acao=lista");
	}

?>