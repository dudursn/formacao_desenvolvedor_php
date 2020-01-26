<?php

namespace Alura\Doctrine\Entity;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Entity\Curso;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity
 * @Table(name="aluno")
 */
class Aluno {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="aluno_id");
     */
    private $alunoId;

    /**
     * @Column(
     *  type="string", 
     *  length=80, 
     *  name="nome")
     */
    private $nome;

    /**
     * @Column(type="integer", name="idade")
     */
    private $idade;

    /**
     * @OneToMany(targetEntity="Telefone", mappedBy="aluno", cascade={"remove", "persist"})
     */
    private $telefones;

    /**
    * @ManyToMany(targetEntity="Curso", inversedBy="alunos")
    */
    private $cursos;

    public function __construct(){
        $this->alunoId = 0;
        $this->nome = "";
        $this->idade = 0;
        $this->telefones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cursos = new \Doctrine\Common\Collections\ArrayCollection();

    }

    public function getAlunoId()
    {
        return $this->alunoId;
    }
 
    public function setAlunoId($alunoId):self
    {
        $this->alunoId = $alunoId;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    } 
    public function setNome($nome):self
    {
        $this->nome = mb_strtoupper($nome);

        return $this;
    }


    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * @return  self
     */ 
    public function setIdade($idade)
    {
        $this->idade = $idade;

        return $this;
    }


    public function getTelefones():Collection
    {
        return $this->telefones;
    }

    /**
     * Set the value of telefones
     *
     * @return  self
     */ 
    public function addTelefone(Telefone $telefone)
    {
        $this->telefones->add($telefone);
        $telefone->setAluno($this);
        
        return $this;
    }

    public function getCursos()
    {
        return $this->cursos;
    }

    /**
     * @return  self
     */ 
    public function addCurso(Curso $curso)
    {
        
        if($this->cursos->contains($curso)){
            return $this;
        }

        $this->cursos->add($curso);
        $curso->addAluno($this);
       
        return $this;
    }

    public function removeCurso(Curso $curso): bool
    {
        if($this->cursos->contains($curso)){
            $this->cursos->removeElement($curso);
            $curso->removeAluno($this);
        }

        return $this;
    }
}


?>