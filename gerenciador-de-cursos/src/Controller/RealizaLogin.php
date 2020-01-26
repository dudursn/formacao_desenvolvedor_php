<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Usuario;

use Alura\Cursos\Config\{
    CursoConfig,
    LoginConfig
};

class RealizaLogin implements InterfaceControladorRequisicao
{
	
    private $entityManager;

	public function __construct(){

		$this->entityManager = (new EntityManagerCreator())->getEntityManager();
	}

	public function processaRequisicao():void{
		try{

            $email = filter_input(INPUT_POST, "txtEmail", FILTER_VALIDATE_EMAIL   );

            $_SESSION["alert"] = "alert-danger";
            if(is_null($email) || $email === false || trim($email)==""){
                $_SESSION["msg"] = "Email inválido. ";
                header("Location: " . LoginConfig::inicio() );
            }

            $senha = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING    );
            if(is_null($senha) && $senha === false || trim($senha)==""){
                $_SESSION["msg"] = "Senha inválida. ";
                header("Location: " . LoginConfig::inicio() );
            }

            $usuarioRepository = $this->entityManager->getRepository(Usuario::class);
            $usuario = $usuarioRepository->findOneBy([
                "email" => $email,
            ]);        
                                        
            if($usuario!=null){
                if($usuario->senhaEstaCorreta($senha)){
                    $_SESSION["usuario"] = $usuario;
                    $_SESSION["msg"] = "Login realizado com sucesso. ";
                    $_SESSION["alert"] = "alert-success";
                    header("Location: " . CursoConfig::inicio() );
                    exit();
                }else{
                    $_SESSION["msg"] = "Senha inválida. ";
                }
                
            } else{
                $_SESSION["msg"] = "Usuario não encontrado. ";
            }
            
            
            header("Location: ./");
            exit();

        }catch(Exception $e){
            echo $e->getMessage();
        }
		
	}
}