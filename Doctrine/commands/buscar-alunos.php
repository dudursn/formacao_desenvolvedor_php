<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Repository\AlunoRepository;
use Doctrine\Common\Collections\Collection\ArrayCollection;

function printAll($alunos, $mostrarTelefones){
    foreach($alunos as $aluno){
        printAluno($aluno, $mostrarTelefones);
    }
    
}
function printAluno($aluno, $mostrarTelefones){
    echo "ID: " . $aluno->getAlunoId() ."\n";
    echo "Nome: " . $aluno->getNome() . "\n";
    echo "Idade: " . $aluno->getIdade() . "\n";
    if($mostrarTelefones){
        printTelefones2($aluno);
    }

    echo "-----------------------\n";
}

function printTelefones1($aluno){
   
    $telefones = $aluno
        ->getTelefones()
        ->map(function (Telefone $telefone){
            return $telefone->getNumero();
        })
        ->toArray();

   
    echo "Telefones: " . implode(',', $telefones)."\n";
    
}

function printTelefones2($aluno){
   
    $telefones = $aluno->getTelefones();
    $txt = "Telefones: ";
    foreach($telefones as $telefone){
        $txt .=  $telefone->getNumero() . ", ";
    }
    echo $txt . "\n";
    
}

//require_once $_SERVER["DOCUMENT_ROOT"] . "/doctrine-alura/global.php";
require_once __DIR__ . "/../vendor/autoload.php";

try{
    $alunoRepository = new AlunoRepository();

   
    echo "Find all\n";
    $alunos = $alunoRepository->findAll();
    printAll($alunos, true);

    /*
    echo "\n\nFind by id\n";
    $aluno = $alunoRepository->findById(4);
    printAluno($aluno, false);
    

    echo "\n\nFind by nome (Mais de um)\n";
    $alunos = $alunoRepository->findByNome("Sergio Lopes");
    printAll($alunos, false);

    echo "\n\nFind by nome (Só um)\n";
    $aluno = $alunoRepository->findOneByNome("Sergio Lopes");
    printAluno($aluno, false);
   */
}
catch(Exception $e){
    echo $e;
}



?>