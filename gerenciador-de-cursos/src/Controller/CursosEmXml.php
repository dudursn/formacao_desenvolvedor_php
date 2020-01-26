<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class CursosEmXml extends ControllerComHtml implements InterfaceControladorRequisicao 
{ 
	private $repositorioDeCursos; 

	public function __construct(){
		$entityManager = (new EntityManagerCreator())->getEntityManager();
		$this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
	}

	public function processaRequisicao():void{
		
        $cursos = $this->repositorioDeCursos->findAll();
        
        $cursosEmXml = new \SimpleXMLElement('<cursos/>');

        foreach ($cursos as $curso) {
            $cursoEmXml = $cursosEmXml->addChild('curso');
            $cursoEmXml->addChild('id', $curso->getId());
            $cursoEmXml->addChild('descricao', $curso->getDescricao());
        }

        $dados = array(
			"tipoAplicacao" => "application/xml",
            "cursosFormato" => $cursosEmXml->asXML()
        );

		echo $this->renderizaHtml("json/cursos-aplicacao.php", $dados);	
	}
}