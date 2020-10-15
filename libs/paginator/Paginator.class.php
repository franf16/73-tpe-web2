<?php

/** Paginador de resultados de búsqueda. */
class Paginator {

    // private int $size;
    private array $params;

    /**
     * @param $els_name Nombre de los elementos (para asignar en el tpl)
     * @param $els_per_page Elementos mostrados por página
     * @param $model Modelo de donde sacar los datos
     * @param $params Definición de los parámetros de la query
     */
    public function __construct(string $els_name, int $els_per_page, Model $model, array $params = []) {
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?? 1; // default page 1

        $tot_elements = $model->count($params);
        // $this->size = $model->count($params);

        $elements = $model->getElements(array_merge($params, [
            'limit' => $els_per_page,
            'offset' => ($page - 1) * $els_per_page
        ]));
        
        $url_page_href = preg_match('/page/', THIS_URL) ? preg_replace('/page=[\d]&?/', '', THIS_URL) : THIS_URL;
        if (!preg_match('/[&?]$/', $url_page_href)) { // si no termina en & o ?, agregar & para concatenar parametro
            $url_page_href .= '&';
        }
        // var_dump($url_page_href);
        // die();
        $this->params = [
            $els_name => $elements,
            'els_per_page' => $els_per_page,
            'tot_elements' => $tot_elements,
            'page' => $page,
            'tot_pages' => $tot_elements / $els_per_page,
            'url_page_href' => $url_page_href
        ];
    }

    /** Muestra una página
     *  @param $tpl_name Nombre del template
     *  @param $view Vista para mostrar la página
     *  @param $vars Variables extra para el template
     */
    public function render(string $tpl_name, View $view, array $vars = []): void {
        $view->render($tpl_name, array_merge($this->params, $vars));
    }

    // public function size(): int { return $this->size; }
    // public function getParams(): array { return $this->params; }
}