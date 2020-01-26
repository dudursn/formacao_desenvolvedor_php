<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioNovoCurso implements InterfaceControladorRequisicao
{
	
	public function __construct(){
		
	}

	public function processaRequisicao():void{
		$titulo = "Novo Curso";
		require __DIR__ . '/../../public/view/cursos/formulario-novo-curso.php';
		
	}
}