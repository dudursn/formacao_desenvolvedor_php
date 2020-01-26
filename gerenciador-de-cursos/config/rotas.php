<?php


use Alura\Cursos\Controller\{
    ListarCursos,
    FormularioCurso,
    Persistencia,
    DeleteCurso,
    FormularioLogin,
    RealizaLogin,
    CabecalhoController,
    Sair,
    CursosEmJson,
    CursosEmXml
};

$rotas = [
    "listar-cursos" => ListarCursos::class,
    "novo-curso" => FormularioCurso::class,
    "atualiza-curso" => FormularioCurso::class,
    "salvar-curso" => Persistencia::class,
    "delete-curso" => DeleteCurso::class,
    "formulario-login" => FormularioLogin::class,
    "realiza-login" => RealizaLogin::class,
    "cabecalho" => CabecalhoController::class,
    "encerrar" => Sair::class,
    "buscarCursosEmJson" => CursosEmJson::class,
    "buscarCursosEmXml" => CursosEmXml::class
    
];

return $rotas;

?>