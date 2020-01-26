<?php

namespace Alura\Doctrine\Entity;
use Alura\Doctrine\Entity\Aluno;
/**
 * @Entity
 * @Table(name="telefone")
 */
class Telefone{

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="telefone_id")
     */
    private $telefoneId;

    /**
     * @Column(type="string", name="numero")
     */
    private $numero;

    /**
     * @ManyToOne(targetEntity="Aluno", inversedBy="telefones")
     * @JoinColumn(name="aluno_id", referencedColumnName="aluno_id")
     */
    private $aluno;

    public function __construct(){

        $this->telefoneId = 0;
        $this->numero = "";
        $this->aluno = new Aluno();
    }

    /**
     * Get the value of telefoneId
     */ 
    public function getTelefoneId()
    {
        return $this->telefoneId;
    }

    /**
     * Set the value of telefoneId
     *
     * @return  self
     */ 
    public function setTelefoneId($telefoneId)
    {
        $this->telefoneId = $telefoneId;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of aluno
     */ 
    public function getAluno():Aluno
    {
        return $this->aluno;
    }

    /**
     * Set the value of aluno
     *
     * @return  self
     */ 
    public function setAluno(Aluno $aluno)
    {
        $this->aluno = $aluno;

        return $this;
    }
}
?>