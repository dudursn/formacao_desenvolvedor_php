<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Repository\AlunoRepository;


//require_once $_SERVER["DOCUMENT_ROOT"] . "/doctrine-alura/global.php";
require_once __DIR__ . "/../vendor/autoload.php";

$aluno = new Aluno();
$aluno->setNome($argv[1]);
$aluno->setIdade($argv[2]);


for($i=3; $i < $argc; $i++){

    $numero = $argv[$i];

    $telefone = new Telefone();
    $telefone->setNumero($numero);
    
    $aluno->addTelefone($telefone);
}

$alunoRepository = new AlunoRepository();
$aluno = $alunoRepository->save($aluno);
echo $aluno->getAlunoId();



?>