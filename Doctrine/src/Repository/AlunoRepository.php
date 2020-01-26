<?php

namespace Alura\Doctrine\Repository;

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Helper\EntityManagerFactory;

class AlunoRepository{

    private $entityManager;
    private $className =  Aluno::class;

    public function __construct(){

        $entityManagerFactory = new EntityManagerFactory();
        $this->entityManager = $entityManagerFactory->getEntityManager();  
        
    }

    public function buscaCursosPorAluno()
    {  
        $dql = "SELECT a, t, c FROM $this->className a JOIN a.telefones t JOIN a.cursos c";
        $query = $this->entityManager->createQuery($dql);
        return $query->getResult();
    }

    public function buscaCursosPorAlunoQueryBuilder($carregarColecao)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder()->select("a")
                    ->from($this->className, "a");

        if($carregarColecao){
            $queryBuilder->join("a.telefones", "t")
                ->join("a.cursos", "c")
                ->addSelect("t")
                ->addSelect("c");
        }
        $query = $queryBuilder->getQuery();
        
        return $query->getResult();
    }
   
    public function save($curso){
      
        if($curso->getAlunoId()==0){
            
            return $this->insert($curso);
        }else{
            
            return $this->update($curso);
        }
    }

    private function insert($aluno){

        $this->entityManager->persist($aluno);
        $this->entityManager->flush();
        return $aluno;
    }

    private function update($aluno){

        $this->entityManager->merge($aluno);
        $this->entityManager->flush();
        return $aluno;
    }

    public function delete($alunoId){
        
        $aluno = $this->entityManager->getReference($this->className, $alunoId);
        $this->entityManager->remove($aluno);
        $this->entityManager->flush();
        return $aluno;        
    }
    
    public function findAll(){

        $alunoRepository = $this->entityManager->getRepository($this->className);
        /**
        * #var Aluno[] $alunoList
        */
        $alunoList = $alunoRepository->findAll();
        return $alunoList;

    }
    
    public function findById($id){

        return $this->entityManager->find($this->className, $id);
    }

    public function findBy($nome, $idade){

        $alunoRepository = $this->entityManager->getRepository($this->className);
        $alunoList = $alunoRepository->findBy([
            "nome" => $nome,
            "idade" => $idade
        ]);

        return $alunoList;
    }

    public function findOneByNome($nome){

        $alunoRepository = $this->entityManager->getRepository($this->className);
        $aluno = $alunoRepository->findOneBy([
            "nome" => $nome,
        ]);

        return $aluno;
    }

    public function findByNome($nome){

        $alunoRepository = $this->entityManager->getRepository($this->className);
        $alunoList = $alunoRepository->findBy([
            "nome" => $nome
        ]);

        return $alunoList;
    }

    public function findByIdade($idade){

        $alunoRepository = $this->entityManager->getRepository($this->className);        
        $alunoList = $alunoRepository->findBy([
            "nome" => $idade
        ]);

        return $alunoList;
    }

    public function addDebugStack($debugStack){
        $this->entityManager->getConfiguration()->setSQLLogger($debugStack);
    }
    
    public function getCount(){
        $dql = "SELECT COUNT(a) FROM $this->className a";
        $query = $this->entityManager->createQuery($dql);
        return $query->getSingleScalarResult();
    }

    public function getMediaIdades(){
        $dql = "SELECT AVG(a.idade) FROM $this->className a";
        $query = $this->entityManager->createQuery($dql);
        return $query->getSingleScalarResult();
    }
    
}