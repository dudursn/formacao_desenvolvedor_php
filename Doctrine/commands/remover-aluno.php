<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Repository\AlunoRepository;


//require_once $_SERVER["DOCUMENT_ROOT"] . "/doctrine-alura/global.php";
require_once __DIR__ . "/../vendor/autoload.php";

$alunoRepository = new AlunoRepository();
$aluno = $alunoRepository->delete($argv[1]);
echo $aluno->getAlunoId();



?>