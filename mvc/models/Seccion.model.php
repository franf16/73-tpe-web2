<?php

require_once './libs/mvc/Model.class.php';

class SeccionModel extends Model {

    public function __construct() {
        parent::__construct('seccion');
    }

    public function getParamsDefinition(): array {
        return [
            'nombre' => FILTER_SANITIZE_STRING,
            'descripcion' => FILTER_SANITIZE_STRING,
        ];
    }
    
    public function getParamsRequired(): array {
        return [ 'nombre' ];
    }
}