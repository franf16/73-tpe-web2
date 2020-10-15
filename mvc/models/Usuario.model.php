<?php

require_once('./libs/mvc/Model.class.php');

class UsuarioModel extends Model {

    public function __construct() {
        parent::__construct('usuario');
    }

    public function getParamsDefinition(): array {
        return [
            'username' => FILTER_SANITIZE_STRING,
            'email' => FILTER_VALIDATE_EMAIL,
            'password' => FILTER_DEFAULT
        ];
    }
    
    public function getParamsRequired(): array {
        return [ 'username', 'email', 'password' ];
    }
}