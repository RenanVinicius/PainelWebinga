<h1>ADMINISTRADORES DO SITE</h1>
<br />
<a href="index.php?secao=modulos/admin&acao=inserir" role="button" class="btn btn-info">INSERIR NOVO</a> 
<br />
<br />
<?php 
	if(@$_GET["acao"] == "lista"):
	$sql = mysql_query("SELECT * FROM admin WHERE email <> 'sites@webinga.com.br' ORDER BY ID DESC");
	if(mysql_num_rows($sql) == false):
	echo '<div style="text-align:center;" class="alert alert-info">Nenhum administrador cadastrado</div>';
	else:
?>
    <table class="table table-hover" style="width:100%;">
		<thead>
			<tr>
				<th width="28%">Nome</th>
				<th width="55%">E-mail</th>
				<th width="17%">A&ccedil;&atilde;o</th>
			</tr>
		</thead>
		<tbody>
        <?php 
		while($ln = mysql_fetch_object($sql)):
		?>
		<tr>
			<td><?php echo $ln->nome; ?></td>
			<td><?php echo $ln->email; ?></td>
			<td>
               <a href="index.php?secao=modulos/admin&acao=editar&ID=<?php echo $ln->ID; ?>" role="button" class="btn btn-info" data-toggle="modal">Editar</a> 
               <a href="index.php?secao=modulos/admin&acao=deletar&ID=<?php echo $ln->ID; ?>" class="btn btn-danger" onClick="return confirm('Deseja deletar?');">Deletar</a>
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
	$email = (!empty($_POST['email'])) ? $_POST['email'] : '';
	$senha = (!empty($_POST['senha'])) ? $_POST['senha'] : '';
?>
<form name="inserirAdmin" method="post" action="index.php?secao=modulos/admin&acao=inserir">
  <div>Nome</div>
  <input required style="width:350px;" type="text" name="nome" id="nome" value="<?php echo $nome; ?>" />
  <div>E-mail</div>
  <input required style="width:350px;" type="email" name="email" id="email" value="<?php echo $email; ?>" />
  <div>Senha</div>
  <input required style="width:350px;" type="password" name="senha" id="senha" value="<?php echo $senha; ?>" />
  <br />
  <input type="submit" id="enviar" name="enviar" class="btn btn-primary" value="ENVIAR" />
</form>
<?php 
	
	if(@$_POST){
		
		extract($_POST);
		
		if(numRows("admin", "WHERE email = '$email'") == true){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
				Este e-mail j&aacute; est&aacute; sendo utilizado por outro usu&aacute;rio
			</div>
			';
		}else{
		
		$insere = insert(array("nome", "email", "senha"), array("$nome", "$email", "".md5($senha).""), "admin");
		
			if($insere == true){
				echo '
				<div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				Usu&aacute;rio cadastrado com sucesso. <a href="index.php?secao=modulos/admin&acao=inserir"><strong>Inserir outro</strong></a> ou <a href="index.php?secao=modulos/admin&acao=lista"><strong>Listar todos</strong></a>
				</div>
				';
			}
		
		}
		
	}
	
	endif; 
		
?>

<?php 
	if(@$_GET["acao"] == "editar"): 
?>
<form name="inserirAdmin" method="post" action="index.php?secao=modulos/admin&acao=editar&ID=<?php echo $_GET["ID"]; ?>">
  <div>Nome</div>
  <input required style="width:350px;" type="text" name="nome" id="nome" value="<?php echo uniqSelect("admin", "nome", "WHERE ID = '".$_GET["ID"]."'"); ?>" />
  <div>E-mail</div>
  <strong><?php echo uniqSelect("admin", "email", "WHERE ID = '".$_GET["ID"]."'"); ?></strong>
  <div>Senha</div>
  <input style="width:350px;" type="password" name="senha" id="senha" />
  <br />
  <input type="submit" id="enviar" name="enviar" class="btn btn-primary" value="ENVIAR" />
  <input type="hidden" name="senhaAtual" id="senhaAtual" value="<?php echo uniqSelect("admin", "senha", "WHERE ID = '".$_GET["ID"]."'"); ?>" />
</form>
<?php 

	if(@$_POST){
		
		extract($_POST);
		
		if($senha == true){
			$newSenha = md5($senha);
		}else{
			$newSenha = $senhaAtual;
		}

		$atualiza = update(
		array("nome", "senha"), 
		array("$nome", "".$newSenha.""),
		"admin", "WHERE ID = '".$_GET["ID"]."'"
		);
			
		if($atualiza){
			echo '
			<div class="alert alert-success fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			Usu&aacute;rio atualziado com sucesso. <a href="index.php?secao=modulos/admin&acao=lista"><strong>Listar todos</strong></a>
			</div>
			';
		}else{
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
				Erro ao atualizar, tente novamente mais tarde. <a href="index.php?secao=modulos/admin&acao=lista"><strong>Listar todos</strong></a>
			</div>
			';
		}
	}

	endif;
	
?>

<?php 
	if(@$_GET["acao"] == "deletar"){
		delete("admin", "WHERE ID = '".$_GET["ID"]."'");
		header("Location: index.php?secao=modulos/admin&acao=lista");
	}
?>