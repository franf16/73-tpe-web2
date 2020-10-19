<?php

require_once './libs/mvc/Controller.class.php';
require_once './libs/functions/str_url_format.function.php';
require_once './libs/functions/redirect.function.php';
// require_once './libs/paginator/Paginator.class.php';

require_once './mvc/models/Seccion.model.php';
require_once './mvc/models/Noticia.model.php';

class NoticiaController extends Controller {

    public function __construct() {
        parent::__construct('noticia', new NoticiaModel);
        $this->seccionModel = new SeccionModel;
    }

    /** Página con las noticias ordenadas por más reciente */
    public function showHome() {
        $noticias = $this->model->getElements([ 
            'view' => 'noticia_preview',
            'order' => 'fecha desc' 
        ]);
        $this->view->render('page_home', [
            'noticias' => $noticias
        ]);
        // $paginator = new Paginator('noticias', 3, $this->model, [ 
        //     'view' => 'noticia_preview',
        //     'order' => 'fecha desc' 
        // ]);
        // $paginator->render('page_home', $this->view);
    }

    /** Redirect para mostrar el título del artículo en la URL */
    public function showNoticiaRedirect($params) {
        $id = $params[ ':ID' ];
        try {
            $this->validateId($id);
            $nombreNoticia = $this->model->get('titulo', $id);
            $nombreFormat = str_url_format($nombreNoticia);
            redirect(NOTICIA . "/$id/$nombreFormat");
        }
        catch (Exception $e) { $this->view->renderError($e); }
    }
    public function showNoticia($params) {
        $id = $params[ ':ID' ];
        try {
            $this->validateId($id);
            $noticia = $this->model->getElementById($id);

            // Si la noticia no fue ya visualizada en la sesión, agrega una visualización.
            $noticiasVistas = & Auth::get('noticias_vistas') ?? Auth::set('noticias_vistas', []);
            if (!in_array($id, $noticiasVistas)) {
                array_push($noticiasVistas, $id);
                $this->model->addVisualizacion($id);
            }

            $this->view->render('page_noticia', [
                'noticia' => $noticia
            ]);
        }
        catch (Exception $e) { $this->view->renderError($e); }
    }

    /** Resultados del buscador del nav */
    public function showResultados() {
        $searchQuery = trim(filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING));
        if ($searchQuery) {
            $noticias = $this->model->getElements([
                'where' => [
                    [ 'titulo', 'like', "%$searchQuery%" ],
                    [ 'descripcion', 'like', "%$searchQuery%" ],
                    [ 'texto', 'like', "%$searchQuery%" ],
                    'strict' => false 
                ],
                'order' => 'visualizaciones desc'
            ]);
            $this->view->render('page_resultados', [
                'noticias' => $noticias,
                'tot_resultados' => count($noticias),
                'query' => $searchQuery
            ]);
        }
        else redirect(HOME);
    }

    public function getFormParams(): array {
        return [
            'secciones' => $this->seccionModel->getElements()
        ];
    }
}