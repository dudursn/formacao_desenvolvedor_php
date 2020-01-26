<?php

namespace Alura\Cursos\Config;

class CursoConfig
{
    public static function inicio(){
        return '/gerenciador-de-cursos/listar-cursos';
    }

    public static function salvar(){
        return '/gerenciador-de-cursos/salvar-curso';
    }

    public static function novo(){
        return '/gerenciador-de-cursos/novo-curso';
    }

    public static function editar($id){
        return '/gerenciador-de-cursos/atualiza-curso/'. $id;
    }

    public static function apagar($id){
        return '/gerenciador-de-cursos/delete-curso/' . $id;
    }
}
