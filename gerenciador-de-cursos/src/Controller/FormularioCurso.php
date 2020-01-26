<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioCurso extends ControllerComHtml implements InterfaceControladorRequisicao
{
	
	private $entityManager;

	public function __construct(){

		$this->entityManager = (new EntityManagerCreator())->getEntityManager();
	}

	public function processaRequisicao():void{

		$titulo = "Novo Curso";
		$curso = new Curso();
	
		if(isset($_GET["id"])){

			$titulo = "Editar Curso";
			$id =  filter_var($_GET["id"], FILTER_VALIDATE_INT);
			$curso = null;
			if(!is_null($id) && $id !== false){
			  
				$curso = $this->entityManager->find(Curso::class, $id);				
			}

			if(is_null($curso)) {
				http_response_code(404);
				exit();
			}
		}
		$dados = array(
			"titulo" => $titulo,
			"curso" => $curso
		);

		echo $this->renderizaHtml("cursos/formulario-curso.php", $dados);		
	}
}