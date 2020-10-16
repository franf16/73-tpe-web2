<?php

require_once './libs/mvc/Controller.class.php';
require_once './libs/functions/str_url_format.function.php';
require_once './libs/functions/redirect.function.php';

require_once './mvc/models/Noticia.model.php';
require_once './mvc/models/Seccion.model.php';

class SeccionController extends Controller {

    private NoticiaModel $noticiaModel;

    public function __construct() {
        parent::__construct('seccion', new SeccionModel);
        $this->noticiaModel = new NoticiaModel;
    }

    /** Página con las secciones */
    public function showSecciones() {
        $secciones = $this->model->getElements();
        $this->view->render('page_secciones', [
            'secciones' => $secciones
        ]);
    }

    /** Redirect para mostrar el título de la sección en la URL */
    public function showSeccionRedirect($params) {
        $id = $params[ ':ID' ];
        try {
            $this->validateId($id);
            $nombreSeccion = $this->model->get('nombre', $id);
            $nombreFormat = str_url_format($nombreSeccion);
            // header("Location: " . SECCION . "/$id/$nombreFormat");
            redirect(SECCION . "/$id/$nombreFormat");
        }
        catch (Exception $e) { $this->view->renderError($e); }
    }
    /** Página de una sección con sus noticias ordenadas por más vistas */
    public function showSeccion($params) {
        $id = $params[ ':ID' ];
        try {
            $this->validateId($id);
            $seccion = $this->model->getElementById($id);
            $noticias = $this->noticiaModel->getElements([
                'view' => 'noticia_preview',
                'where' => [ 'id_seccion', '=', $id ],
                'order' => 'visualizaciones desc'
            ]);
            $this->view->render('page_seccion', [
                'seccion' => $seccion,
                'noticias' => $noticias
            ]);
        }
        catch (Exception $e) { $this->view->renderError($e); }
    }
}