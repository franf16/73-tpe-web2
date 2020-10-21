<?php

require_once './libs/mvc/Model.class.php';
require_once './libs/auth/Auth.class.php';
require_once './libs/functions/redirect.function.php';

require_once './libs/api/APIView.class.php';

class APIController {

    protected Model $model;
    protected ApiView $view;

    protected string $table;

    public function __construct(string $table, Model $model) {
        $this->table = $table;
        $this->model = $model;
        $this->view = new APIView;
    }

    public function get($params = []) {
        $elements = $this->model->getElements();
        $this->view->response($elements, 200);
    }
}