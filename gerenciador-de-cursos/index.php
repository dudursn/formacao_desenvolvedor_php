<?php

use Alura\Cursos\Controller\{
	FormularioLogin,
	CabecalhoController
};
use Alura\Cursos\Config\{
	LoginConfig,
	CursoConfig
};

require __DIR__ . "/vendor/autoload.php";
session_start();
$rotas = require __DIR__ . "/config/rotas.php";

try{
	$urlBase = (isset($_GET["url"])) ? $_GET["url"] : "";
	$url = array_filter(explode("/", $urlBase));

	if(count($url)===0){

		if(!isset($_SESSION["usuario"])){

			header("Location: ". LoginConfig::inicio());
		}
		else{

			header("Location: ". CursoConfig::inicio());
		}
		
		exit();
	}

	$parametro = $url[0];

	$ehRotaDeLogin = stripos($parametro, "login");
	if (!isset($_SESSION["usuario"]) && $ehRotaDeLogin===false) {
		header("Location: ". LoginConfig::inicio());
		exit();
	}
		
	
	if(!array_key_exists($parametro, $rotas)){
		http_response_code(404);
		exit();
	}

	if(isset($url[1])){
		$id = filter_var($url[1], FILTER_VALIDATE_INT);
		if(!is_null($id) && $id !== false){
			$_GET["id"] = $url[1];
		}else{
			http_response_code(404);
			exit();
		}
	} 

	$controladorClasse = $rotas[$parametro];
	$controlador = new $controladorClasse();
	$controlador->processaRequisicao();
	

}catch (Exceptio $e){
	echo $e->getMessage();
}
	


?>