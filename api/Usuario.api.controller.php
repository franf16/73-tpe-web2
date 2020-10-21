<?php

require_once './libs/api/APIController.class.php';

require_once './mvc/models/Usuario.model.php';

class UsuarioAPIController extends APIController {
    
    public function __construct() {
        parent::__construct('usuario', new UsuarioModel);
    }
}