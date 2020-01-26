<?php
use Alura\Cursos\Controller\{
	
	CabecalhoController
};
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"> </script>

</head>
<body>
<div class="container">
    <?php
    if(isset($_SESSION["usuario"])): 
			$controladorCabecalho = new CabecalhoController();
			$controladorCabecalho->processaRequisicao();
			$controladorCabecalho = null;
        endif; 
        
    ?>