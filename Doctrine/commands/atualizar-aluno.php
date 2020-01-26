<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Repository\AlunoRepository;


//require_once $_SERVER["DOCUMENT_ROOT"] . "/doctrine-alura/global.php";
require_once __DIR__ . "/../vendor/autoload.php";

$aluno = new Aluno();
$aluno->setAlunoId($argv[1]);
$aluno->setNome($argv[2]);
$aluno->setIdade($argv[3]);

$alunoRepository = new AlunoRepository();
$aluno = $alunoRepository->update($aluno);
echo $aluno->getAlunoId();



?>