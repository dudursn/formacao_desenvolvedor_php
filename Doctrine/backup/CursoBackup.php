<?php

namespace Alura\Doctrine\Entity;
use Alura\Doctrine\Entity\Aluno;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity
 * @Table(name="curso")
 */
class Curso {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="curso_id");
     */
    private $cursoId;

    /**
     * @Column(
     *  type="string", 
     *  length=80, 
     *  name="nome")
     */
    private $nome;

    /**
     * @ManyToMany(targetEntity="Aluno", mappedBy="cursos")
     * @JoinTable(
     *  name="cursos_alunos",
     *  joinColumns={
     *      @JoinColumn(name="curso_id", referencedColumnName="curso_id")
     *  },
     *  inverseJoinColumns={
     *      @JoinColumn(name="aluno_id", referencedColumnName="aluno_id")
     *  }
     *)
     */
    private $alunos;

    public function __construct(){
        $this->cursoId = 0;
        $this->nome = "";
        $this->alunos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getCursoId()
    {
        return $this->cursoId;
    }

    /**
     * @return  self
     */ 
    public function setCursoId($cursoId)
    {
        $this->cursoId = $cursoId;

        return $this;
    }

    /**
     * Get type="string",
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set type="string",
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }


    public function getAlunos()
    {
        return $this->alunos;
    }

    public function addAluno(Aluno $aluno)
    {   
       
        if(!$this->alunos->contains($aluno)){
            $this->alunos->add($aluno);
            $aluno->addCurso($this);
        }

       
        return $this;
    }

    public function removeAluno(Aluno $aluno): bool
    {
        if($this->alunos->contains($aluno)){
            $this->alunos->removeElement($aluno);
            $aluno->removeCurso($this);
        }

        return $this;
    }
}


?>