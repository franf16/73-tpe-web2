<?php

require_once './libs/auth/Auth.class.php';
require_once './libs/functions/getFilterParams.function.php';
require_once './libs/paginator/Paginator.class.php';
require_once './libs/mvc/View.class.php';
require_once './libs/mvc/Model.class.php';

require_once './mvc/models/Noticia.model.php';
require_once './mvc/models/Seccion.model.php';
require_once './mvc/models/Usuario.model.php';
require_once './mvc/models/Comentario.model.php';

class AdminController {

    private View $view;
    private NoticiaModel $noticia;
    private SeccionModel $seccion;
    private UsuarioModel $usuario;
    private ComentarioModel $comentario;

    public function __construct() {
        $this->view = new View;
        /** Inicializar los modelos de las tablas con el nombre de la tabla */
        // $this->nombreTabla = new NombreTablaModel;
        $this->noticia = new NoticiaModel;
        $this->seccion = new SeccionModel;
        $this->usuario = new UsuarioModel;
        $this->comentario = new ComentarioModel;
    }

    /**
     * Muestra el panel de administración.
     * Si recibe una tabla por URL carga sus elementos.
     */
    public function showPanel($params) {
        Auth::checkLogin();
        $table = $params[ ':TABLE' ] ?? null;
        $elements = null;
        if ($table) {
            try {
                Model::validateTable($table);
                $params = getFilterParams($this->{$table});
                $elements = new Paginator('elements', 25, $this->{$table}, $params);
                $elements->render('page_admin-panel', $this->view, [ 'table' => $table ]);
            }
            catch (Exception $e) { $this->view->renderError($e); }
        }
        else {
            $this->view->render('page_admin-panel', [
                'table' => $table,
                'elements' => $elements
            ]);
        }
    }
}