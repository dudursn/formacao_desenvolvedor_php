<?php

namespace Alura\Doctrine\Repository;

use Alura\Doctrine\Entity\Curso;
use Alura\Doctrine\Helper\EntityManagerFactory;

class CursoRepository{

    private $entityManager;
    private $className =  Curso::class;

    public function __construct(){

        $entityManagerFactory = new EntityManagerFactory();
        $this->entityManager = $entityManagerFactory->getEntityManager();   
    }

    public function save($curso){
        echo $curso->getCursoId();
        if($curso->getCursoId()==0){
            
            return $this->insert($curso);
        }else{
            
            return $this->update($curso);
        }
    }

    private function insert($curso){

        $this->entityManager->persist($curso);
        $this->entityManager->flush();
        return $curso;
    }

    private function update($curso){

        $this->entityManager->merge($curso);
        $this->entityManager->flush();
        return $curso;
    }

    public function delete($cursoId){
        
        $curso = $this->entityManager->getReference($this->className, $cursoId);
        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        return $curso;        
    }

    public function findAll(){

        $cursoRepository = $this->entityManager->getRepository($this->className);
        /**
        * #var Curso[] $cursoList
        */
        $cursoList = $cursoRepository->findAll();
        return $cursoList;

    }

    public function findById($id){

        $cursoRepository = $this->entityManager->getRepository($this->className);
        $curso = $cursoRepository->find($id);
        return $curso;
    }

    public function findBy($nome, $cursoId){

        $cursoRepository = $this->entityManager->getRepository($this->className);
        $cursoList = $cursoRepository->findBy([
            "nome" => $nome,
            "curso_id" => $cursoId
        ]);

        return $cursoList;
    }

    public function findOneByNome($nome){

        $cursoRepository = $this->entityManager->getRepository($this->className);
        $curso = $cursoRepository->findOneBy([
            "nome" => $nome,
        ]);

        return $curso;
    }

    public function findByNome($nome){

        $cursoRepository = $this->entityManager->getRepository($this->className);
        $cursoList = $cursoRepository->findBy([
            "nome" => $nome
        ]);

        return $cursoList;
    }

    public function addDebugStack($debugStack){
        $this->entityManager->getConfiguration()->setSQLLogger($debugStack);
    }

}