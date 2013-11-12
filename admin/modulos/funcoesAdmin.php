<?php 
	
	define("VERSAO", "v7.0");
	define("ULTIMA_ATUALIZACAO", "20/10/2013");
	define("DESENVOLVEDOR", "Renan Vinicius");
	define("TITULO", "Webinga - Painel Administrativo");
	
	
	//Verifica sessão
	class AdminLogado{
		
		//Se existir, captura os valores das sessões
		private $email_session;
		private $senha_session;
		
		public function SetDados($email_session, $senha_session){
			$this->email_session = $email_session;
			$this->senha_session = $senha_session;
		}		
		
		private function GetDados(){
			return $this->email_session;
			return $this->senha_session;
		}		
		
		public function MostraResultado(){
			if($this->email_session == false or $this->senha_session == false){
				return false;
			}else{
				$consulta = mysql_query("SELECT * FROM admin WHERE email = '".$this->email_session."' AND senha = '".$this->senha_session."'");
				if(mysql_num_rows($consulta) == false){
					return false;
				}else{
					$ln = mysql_fetch_object($consulta);
					if($this->email_session == $ln->email and $this->senha_session == $ln->senha){
						return true;
					}else{
						return false;
					}
				}
			}
		}
	
	}
	
	$AuthAdmin = new AdminLogado();
	$AuthAdmin->SetDados(@$_SESSION["email_admin"], @$_SESSION["senha_admin"]);
	$AuthAdmin->MostraResultado();
	
	//Permissão
	# 1 = Inserir/Editar/Excluir Administradores
	# 2 = Inserir/Editar/Excluir Galeria e fotos
	# 3 = Inserir/Editar/Excluir Eventos
	# 4 = Inserir/Editar/Excluir Agenda
	# 5 = Inserir/Editar/Excluir Locais
	# 6 = Inserir/Editar/Excluir Parceiros
	# 7 = Inserir/Editar/Excluir Vip
	# 8 = Inserir/Editar/Excluir Publicidade
	# 9 = Inserir/Editar/Excluir Ancoras
	# 10 = Inserir/Editar/Excluir Banners de slide
	# 11 = Configurações gerais do site
	function permissaoAdmin($acessos){
		$consulta = mysql_query("SELECT * FROM admin WHERE email = '".$_SESSION["email_admin"]."' AND permissao = '".$acessos."'") or die (mysql_error());
		if(mysql_num_rows($consulta) == false){
			echo '
			<div class="alert alert-block alert-error fade in" style="text-align:center;">
			Voc&ecirc; n&atilde;o tem permiss&atilde;o para acessar essa p&aacute;gina!
			</div>
			';
			exit;
		}
	}
	
?>