<?php

require_once './libs/mvc/Model.class.php';

/** Función para transformar filter.tpl a $params de Model->getElements() */
function getFilterParams(Model $model): array {
	$params = [];
	
	$search_query = filter_input(INPUT_GET, 'search_query', FILTER_SANITIZE_STRING) ?? null;
	$search_field = filter_input(INPUT_GET, 'search_field', FILTER_SANITIZE_STRING) ?? null;
	if ($search_query && $search_field && $model->containsColumn($search_field))
			$params[ 'where' ] = [ $search_field, 'like', "%$search_query%" ];

    $order_field = filter_input(INPUT_GET, 'order', FILTER_SANITIZE_STRING) ?? null;
    $order = isset($_GET[ 'asc' ]) ? 'ASC' : (isset($_GET[ 'desc' ]) ? 'DESC' : null);
    if ($order && $order_field && $model->containsColumn($order_field))
    	$params[ 'order' ] = "$order_field $order";

    return $params;
}