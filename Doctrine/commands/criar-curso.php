<?php

use Alura\Doctrine\Entity\Curso;
use Alura\Doctrine\Repository\CursoRepository;

//require_once $_SERVER["DOCUMENT_ROOT"] . "/doctrine-alura/global.php";
require_once __DIR__ . "/../vendor/autoload.php";

$curso = new Curso();
$curso->setNome($argv[1]);

$cursoRepository = new CursoRepository();
$curso = $cursoRepository->save($curso);
echo $curso->getCursoId();

/*Finds da vida
$curso = $cursoRepository->findById($argv[1]);
echo $curso->getNome();
*/


?>