<?php

/** Helper para las redirecciones dentro de la aplicación. */
class Redirector {

    private function __construct() {}

    /** 
     * @param $defaultUrl url a cargar si no hay una variable GET 'redirect'.
     * @param $getParams parámetros get a pasar a $defaultUrl
     */
    public static function redirect(string $defaultUrl, string $getParams = null) {
        $redirect = filter_input(INPUT_GET, 'redirect', FILTER_SANITIZE_URL);
        header('Location: /' . BASE_URL . (!empty($redirect) ? $redirect : $defaultUrl . $getParams));
        die();
    }
}