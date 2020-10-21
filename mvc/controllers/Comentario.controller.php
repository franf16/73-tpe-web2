<?php

require_once './libs/mvc/Controller.class.php';

require_once './mvc/models/Comentario.model.php';

class ComentarioController extends Controller {

    public function __construct() {
        parent::__construct('comentario', new ComentarioModel);
    }

    protected function postRedirect(int $id): void {
        redirect(ADMIN . '/' . $this->table);    }
}