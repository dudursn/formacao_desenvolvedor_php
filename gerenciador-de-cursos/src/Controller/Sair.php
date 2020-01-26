<?php

namespace Alura\Cursos\Controller;


class Sair implements InterfaceControladorRequisicao 
{ 
	
	public function __construct(){
	
	}

	public function processaRequisicao():void{
        
        session_destroy();

		header("Location: ./");
	}
}
?>
