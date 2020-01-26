<?php

namespace Alura\Cursos\Controller;


class FormularioLogin extends ControllerComHtml implements InterfaceControladorRequisicao
{
	
	public function __construct(){
		
	}

	public function processaRequisicao():void{

		$titulo = "Login";
		$dados = array(
            "titulo" => $titulo
        );

		echo $this->renderizaHtml("login/formulario-login.php", $dados);		
	}
}