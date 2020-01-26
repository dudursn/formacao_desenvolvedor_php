<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Config\CursoConfig;
use Alura\Cursos\Infra\EntityManagerCreator;

class Persistencia implements InterfaceControladorRequisicao
{
	private $entityManager;

	public function __construct(){

		$this->entityManager = (new EntityManagerCreator())->getEntityManager();
	}

	public function processaRequisicao():void{
		try{

            $id = filter_input(INPUT_POST, "txtCursoId", FILTER_VALIDATE_INT   );
            $descricao = filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING    );

            if(trim($descricao)!=""){
                if(!is_null($id) && $id !== false){

                    $curso = new Curso();
                    $curso->setDescricao($descricao);  

                    if($id!=0){

                        $curso->setId($id);
                        $this->entityManager->merge($curso);
                        $_SESSION["msg"] = "Atualizado com sucesso. ";
                    }
                    else{
                                               
                        $this->entityManager->persist($curso);
                        $_SESSION["msg"] = "Salvo com sucesso. ";
                    }

                    $_SESSION["alert"] = "alert-success";
                    $this->entityManager->flush();
                    header("Location: " . CursoConfig::inicio() );
                    exit();
                }
            }      
            $_SESSION["msg"] = "Erro ao inserir curso. Campo descrição vazio. ";
            header("Location: " . CursoConfig::inicio() );
            exit();

        }catch(Exception $e){
            echo $e->getMessage();
        }
		
	}
}