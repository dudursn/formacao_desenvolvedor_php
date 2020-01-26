<?php


use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Curso;
use Alura\Doctrine\Entity\Telefone;
use Doctrine\DBAL\Logging\DebugStack;
use Alura\Doctrine\Repository\AlunoRepository;



//require_once $_SERVER["DOCUMENT_ROOT"] . "/doctrine-alura/global.php";
require_once __DIR__ . "/../vendor/autoload.php";

function printAll($alunos, $mostrarTudo){
    foreach($alunos as $aluno){
        printAluno($aluno, $mostrarTudo);
    }
    
}
function printAluno($aluno, $mostrarTudo){
    echo "ID: " . $aluno->getAlunoId() ."\n";
    echo "Nome: " . $aluno->getNome() . "\n";
    echo "Idade: " . $aluno->getIdade() . "\n";
    if($mostrarTudo){
        printTelefones1($aluno);
        printCurso($aluno);
    }
    
    echo "\n\n";
    
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

function printCurso($aluno){
    foreach ($aluno->getCursos() as $curso){
        echo "Curso:\n";
        echo "\tID: " . $curso->getCursoId() ."\n";
        echo "\tNome: " . $curso->getNome() . "\n";
    }
}

$alunoRepository = new AlunoRepository();
$debugStack = new DebugStack();
$alunoRepository->addDebugStack($debugStack);

$mostrarTudo = true;
$alunos = $alunoRepository->buscaCursosPorAlunoQueryBuilder($mostrarTudo);
//printAll($alunos, $mostrarTudo);

foreach ($debugStack->queries as $queryInfo){
    echo $queryInfo["sql"]. "\n";
}


?>