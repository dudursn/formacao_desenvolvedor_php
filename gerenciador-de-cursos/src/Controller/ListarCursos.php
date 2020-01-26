<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCursos extends ControllerComHtml implements InterfaceControladorRequisicao 
{ 
	private $repositorioDeCursos; 

	public function __construct(){
		$entityManager = (new EntityManagerCreator())->getEntityManager();
		$this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
	}

	public function processaRequisicao():void{
		$titulo = "Listar Cursos";
		$cursos = $this->repositorioDeCursos->findAll();

		$dados = array(
			"titulo" => $titulo,
			"cursos" => $cursos
		);

		echo $this->renderizaHtml("cursos/listar-cursos.php", $dados);	
	}
}