<?php

require_once './libs/mvc/View.class.php';
require_once './libs/mvc/Model.class.php';
require_once './libs/auth/Auth.class.php';
require_once './libs/functions/redirect.function.php';

abstract class Controller {

    protected Model $model;
    protected View $view;

    protected string $table;

    public function __construct(string $table, Model $model) {
        $this->table = $table;
        $this->model = $model;
        $this->view = new View;
    }

    /** ABM */

    /** Página con el formulario para agregar/editar un elemento */
    public function showElementForm($params = []) {
        $this->checkPermissions();

        $extraParams = $this->getFormParams(); // parametros que pueda necesitar para el form
        if (isset($params[ 'errors' ])) {
            $extraParams[ 'errors' ] = $params[ 'errors' ];
        }

        $id = $params[ ':ID' ] ?? null; // si es edit hay id
        $element = $params[ 'element' ] ?? null; // si hay elemento esta siendo llamada por un error
        
        if ($id) { // si es edit y hay errores vuelve a cargar los datos originales 
            try {
                $this->validateId($id);
                $element = $this->model->getElementById($id);
            } 
            catch (Exception $e) { $this->view->renderError($e); }
        }

        $this->view->render('page_admin-element', array_merge([
            'table' => $this->table,
            'element' => $element
        ], $extraParams));
    }
    public function getFormParams(): array { return []; }

    /** add y edit Element*/
    public function postElement($params = []) {
        $this->checkPermissions();

        $id = $params[ ':ID' ] ?? null;
        if ($id) {
            try { $this->validateId($id); } 
            catch (Exception $e) { $this->view->renderError($e); }
        }

        $params[ 'element' ] = $data = $this->filterInput(INPUT_POST, $this->model->getParamsDefinition());
        $params[ 'errors' ] = $errors = $this->checkRequiredInputs($data, $this->model->getParamsRequired());
        
        if (empty($errors)) {
            $result = $id ? $this->model->editElement($id, $data) : 
                $this->model->addElement($data);
            if ($result[ 'ok' ]) $this->postRedirect($result[ 'id' ] ?? $id);
            else $params[ 'errors' ][] = $result[ 'error' ];
        }

        $this->showElementForm($params); // vuelve a cargar el form con errores
    }
    protected function postRedirect(int $id): void {
        redirect($this->table . '/' . $id);
    }

    public function deleteElement($params) {
        $this->checkPermissions();
        try {
            $this->validateId($params[ ':ID' ]);
            $result = $this->model->deleteElement($params[ ':ID' ]);
            $result[ 'ok' ] ? $this->deleteRedirect($params[ ':ID' ]) :
                $this->view->renderError(new Exception($result[ 'error' ]));
        }
        catch (Exception $e) { $this->view->renderError($e); }
    }
    protected function deleteRedirect(int $id): void {
        redirect('admin/' . $this->table);
    }

    /** CONTROL DATOS */
    protected function validateId(&$id): void {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) throw new Exception("Id no válido");
        if (!$this->model->containsId($id)) throw new Exception("No existe le {$this->table} con id: $id");
    }

    /** Filtra el input recibido segun una definición de $params de filter_input_array() */
    protected function filterInput(int $inputType, array $params): array {
        $data = filter_input_array($inputType, $params);
        foreach ($data as $key => &$e) { 
            if ($params[ $key ] != FILTER_DEFAULT && $e !== false) { // si falla validate queda el false para capturarlo en checkRequired, FILTER_DEFAULT no filtra input (usado para password)
                $e = trim($e);
                if (empty($e)) $e = NULL; // para que el modelo lo inserte como DEFAULT
            }
        }
        return $data;
    }

    /** Control de inputs requeridos */
    protected function checkRequiredInputs(array &$input, array $requiredFields): array {
        $errors = [];
        foreach ($requiredFields as $field) {
            if ($input[ $field ] === false)  $errors[] = ucfirst($field) . ' no válido';
            elseif (empty($input[ $field ])) $errors[] = ucfirst($field) . ' no puede ser vacío';
        }
        return $errors;
    }

    /** Permisos para ABM */
    protected function checkPermissions() {
        Auth::checkLogin();
    }
}