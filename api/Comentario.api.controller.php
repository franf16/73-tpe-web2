<?php

require_once './libs/api/APIController.class.php';

require_once './mvc/models/Comentario.model.php';

class ComentarioAPIController extends APIController {
    
    public function __construct() {
        parent::__construct('comentario', new ComentarioModel);
    }

    public function get($params = []) {
        $id_noticia = filter_var($params[ ':ID_NOTICIA' ], FILTER_VALIDATE_INT);
        $comentarios = $this->model->getElements([
            'view' => 'comentario_view',
            'where' => [ 'id_noticia', '=', $id_noticia ]
        ]);
        $this->view->response($comentarios, 200);
    }
}