<?php

namespace Alura\Doctrine\Entity;
use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Curso;

/**
 * @Entity
 * @Table(name="aluno_curso")
 */
class AlunoCurso {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="aluno_curso_id");
     */
    private $alunoCursoId;

    /**
    * @ManyToOne(targetEntity="Aluno", inversedBy="alunosCursos", cascade={"persist", "remove"})
    * @JoinColumn(name="aluno_id", referencedColumnName="aluno_id")
    */
    private $aluno;

    /**
    * @ManyToOne(targetEntity="Curso", inversedBy="alunosCursos", cascade={"persist", "remove"})
    * @JoinColumn(name="curso_id", referencedColumnName="curso_id")
    */
    private $curso;

    public function __construct(){
        $this->alunoCursoId = 0;
        $this->aluno = new Aluno();
        $this->curso = new Curso();
    }


    /**
     * Get the value of alunoCursoId
     */ 
    public function getAlunoCursoId()
    {
        return $this->alunoCursoId;
    }

    /**
     * Set the value of alunoCursoId
     *
     * @return  self
     */ 
    public function setAlunoCursoId($alunoCursoId)
    {
        $this->alunoCursoId = $alunoCursoId;

        return $this;
    }

    /**
     * Get the value of aluno
     */ 
    public function getAluno()
    {
        return $this->aluno;
    }

    /**
     * Set the value of aluno
     *
     * @return  self
     */ 
    public function setAluno($aluno)
    {
        $this->aluno = $aluno;

        return $this;
    }

    /**
     * Get the value of curso
     */ 
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set the value of curso
     *
     * @return  self
     */ 
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

}