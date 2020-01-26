<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class CursosEmJson extends ControllerComHtml implements InterfaceControladorRequisicao 
{ 
	private $repositorioDeCursos; 

	public function __construct(){
		$entityManager = (new EntityManagerCreator())->getEntityManager();
		$this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
	}

	public function processaRequisicao():void{
		
		$cursos = $this->repositorioDeCursos->findAll();
        $dados = array(
			"tipoAplicacao" => "application/json",
            "cursosFormato" => json_encode($cursos, JSON_PARTIAL_OUTPUT_ON_ERROR + JSON_UNESCAPED_UNICODE)
        );
   
		echo $this->renderizaHtml("json/cursos-aplicacao.php", $dados);	
	}
}