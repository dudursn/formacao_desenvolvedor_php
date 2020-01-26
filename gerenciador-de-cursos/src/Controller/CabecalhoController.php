<?php

namespace Alura\Cursos\Controller;

class CabecalhoController extends ControllerComHtml implements InterfaceControladorRequisicao 
{ 
	
	public function __construct(){
	
	}

	public function processaRequisicao():void{
	
		$titulo = "Gerenciador de Cursos";
        
        $opcoes = array(
            "Inicio" => "listar-cursos",
            "Novo" => "novo-curso",
            "Sair" => "encerrar"
        );
		$dados = array(
            "titulo" => $titulo,
			"opcoes" => $opcoes,
		);

		echo $this->renderizaHtml("cabecalho/cabecalho.php", $dados);	
	}
}