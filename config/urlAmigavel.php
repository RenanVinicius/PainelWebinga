<?php 

	#Isso é para alguma coisa em algum site seu funcionar.
	#Não sei como mas do heitinho que ta funciona, não mexa da qui pra baixo. Apenas coloque o total de pastas que tem.
	#http://site.com.br/site/site = 2 pastas
	#http://site.com.br/site = 1 pasta

	//Pega o nome das pastas
	$pastas = $_SERVER['REQUEST_URI'];
	$separaPastas = explode("/", $pastas);

	//Coloquei aqui o total de pastas
	define("TOTAL_PASTAS", 2);


	if(TOTAL_PASTAS == 2){
		define("PASTA_SITE", $separaPastas[1]."/".$separaPastas[2]);
	}else{
		define("PASTA_SITE", $separaPastas[1]);
	}

	#Retorna o domínio completo
	function root($pasta) {
		$protocolo = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false) ? 'http' : 'https';
		$host      = $_SERVER['HTTP_HOST'];
		if($pasta == true){
			$root = ''.$protocolo.'://'.$host.'/'.$pasta.'/';
		}else{
			$root = ''.$protocolo.'://'.$host.'/';
		}
		return $root;
	}

	#Retorna os valores dos gets -> seo(0), seo(1)...
	function seo($params){
		$seo = explode("/", str_replace(strrchr($_SERVER["REQUEST_URI"], "?"), "", $_SERVER["REQUEST_URI"]));
		array_shift($seo);
		if(PASTA_SITE == true){
			$pastas = $_SERVER['REQUEST_URI'];
			$separaPastas = explode("/", $pastas);
			if(TOTAL_PASTAS == 2){
				return $seo[$params+2];
			}else{
				return $seo[$params+1];
			}
		}else{
			return $seo[$params];
		}
	}

?>