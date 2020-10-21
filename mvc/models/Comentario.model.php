<?php

require_once('./libs/mvc/Model.class.php');

class ComentarioModel extends Model {

    public function __construct() {
        parent::__construct('comentario');
    }

    public function getParamsDefinition(): array {
        return [
            'texto' => FILTER_SANITIZE_STRING,
            'id_usuario' => FILTER_VALIDATE_INT,
            'id_noticia' => FILTER_VALIDATE_INT,
        ];
    }
    
    public function getParamsRequired(): array {
        return [ 'texto', 'id_usuario', 'id_noticia' ];
    }
}