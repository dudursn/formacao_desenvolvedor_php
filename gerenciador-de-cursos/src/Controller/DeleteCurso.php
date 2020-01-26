<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class DeleteCurso implements InterfaceControladorRequisicao
{
	private $entityManager;

	public function __construct(){

		$this->entityManager = (new EntityManagerCreator())->getEntityManager();
	}

	public function processaRequisicao():void{
		try{

            $_SESSION["msg"] = "Erro ao apagar curso. ";
            $_SESSION["alert"] = "alert-danger";

            if(isset($_GET["id"])){

                $id =  filter_var($_GET["id"], FILTER_VALIDATE_INT);
       
                if(!is_null($id) && $id !== false){
                  
                    $curso = $this->entityManager->find(Curso::class, $id);
                    
                    if($curso){
                        
                        $curso = $this->entityManager->getReference(Curso::class, $id);
                        $_SESSION["msg"] = "Curso apagado com sucesso. ";
                        $_SESSION["alert"] = "alert-success";
                        $this->entityManager->remove($curso);
                        $this->entityManager->flush(); 
                    } 
                    
                }
                
            }

            header("Location: ../listar-cursos");
            
        }catch(Exception $e){
            echo '==>' . $e->getMessage();
            exit();
        }
		
	}
}