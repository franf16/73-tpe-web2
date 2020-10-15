<?php

require_once('./libs/mvc/Model.class.php');

class NoticiaModel extends Model {

    public function __construct() {
        parent::__construct('noticia');
        $this->setDefaultView('noticia_full');
    }

    public function addVisualizacion(int $id) {
        $query = $this->db->prepare(
            "UPDATE noticia
             SET visualizaciones = (SELECT visualizaciones FROM noticia WHERE id = ?) + 1
             WHERE id = ?"
        );
        $query->execute([ $id, $id ]);
        return true;
    }

    /** TODO:
     * Noticias de los ultimos x dias:
     * select * from noticia where DATEDIFF(CURRENT_TIMESTAMP, noticia.fecha) <= x;
    */

    public function getParamsDefinition(): array {
        return [
            'titulo' => FILTER_SANITIZE_STRING,
            'descripcion' => FILTER_SANITIZE_STRING,
            'texto' => FILTER_SANITIZE_STRING,
            'fecha' => FILTER_SANITIZE_STRING,
            'id_seccion' => FILTER_VALIDATE_INT
        ];
    }
    public function getParamsRequired(): array {
        return [ 'titulo', 'id_seccion' ];
    }
}