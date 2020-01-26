<?php


use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Curso;
use Alura\Doctrine\Entity\Telefone;
use Doctrine\DBAL\Logging\DebugStack;
use Alura\Doctrine\Repository\AlunoRepository;



//require_once $_SERVER["DOCUMENT_ROOT"] . "/doctrine-alura/global.php";
require_once __DIR__ . "/../vendor/autoload.php";

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
        printTelefones1($aluno);
    }

    
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

function printCurso($curso){
    echo "Curso:\n";
    echo "\tID: " . $curso->getCursoId() ."\n";
    echo "\tNome: " . $curso->getNome() . "\n";
}

$alunoRepository = new AlunoRepository();

$debugStack = new DebugStack();
$alunoRepository->addDebugStack($debugStack);
/** @var Aluno[] alunos */
$alunos = $alunoRepository->findAll();

foreach($alunos as $aluno){
    //printAluno($aluno, true);
    $cursos = $aluno->getCursos();
    foreach($cursos as $curso){
        //printCurso($curso);
    }
    echo "-----------------------\n";
}

//print_r($debugStack);

foreach ($debugStack->queries as $queryInfo){
    echo $queryInfo["sql"]. "\n";
}


?>