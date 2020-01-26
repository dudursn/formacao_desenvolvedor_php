<?php

namespace Alura\Doctrine\Repository;

use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;

class TelefoneRepository{

    private $entityManager;
    private $className =  Telefone::class;

    public function __construct(){

        $entityManagerFactory = new EntityManagerFactory();
        $this->entityManager = $entityManagerFactory->getEntityManager();   
    }

    public function insert($telefone){

        $this->entityManager->persist($telefone);
        $this->entityManager->flush();
        return $telefone;
    }

    public function update($telefone){

        $this->entityManager->merge($telefone);
        $this->entityManager->flush();
        return $telefone;
    }

    public function delete($telefoneId){
        
        $telefone = $this->entityManager->getReference($this->className, $telefoneId);
        $this->entityManager->remove($telefone);
        $this->entityManager->flush();
        return $telefone;        
    }

    public function findAll(){

        $telefoneRepository = $this->entityManager->getRepository($this->className);
        /**
        * #var Telefone[] $telefoneList
        */
        $telefoneList = $telefoneRepository->findAll();
        return $telefoneList;

    }

    public function findById($id){

        $telefoneRepository = $this->entityManager->getRepository($this->className);
        $telefone = $telefoneRepository->find($id);
        return $telefone;
    }

    public function findByAluno($alunoId){

        $telefoneRepository = $this->entityManager->getRepository($this->className);
        $telefoneList = $telefoneRepository->findBy([
            "aluno_id" => $alunoId
        ]);

        return $telefoneList;
    }
   
    public function addDebugStack($debugStack){
        $this->entityManager->getConfiguration()->setSQLLogger($debugStack);
    }

}