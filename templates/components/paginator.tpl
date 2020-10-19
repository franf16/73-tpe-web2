{* Paginador de resultados de búsquedas:
    - $url_page_href : url para cargar una página (si ya tenía seteado GET PARAM page, se lo saca para a agregarlo al final)
    - Uso: incluir este tpl en la página que se quiere paginar. Desde php instanciar un Paginator y mostrar la página con Paginator->render(...)
*}
<div class="paginator">
    {if $tot_pages > 1}
        <ul class="paginator-pages">
            {if $page > 1}
                <li><a href="{$url_page_href}page={$page-1}">Anterior</a></li>
            {/if}
            {for $i=1 to $tot_pages}
                <li>
                    {if ($i == $page)}
                        <strong>{$i}</strong>
                    {else}
                        <a href="{$url_page_href}page={$i}">{$i}</a>
                    {/if}
                </li>
            {/for}
            {if $page < $tot_pages}
                <li><a href="{$url_page_href}page={$page+1}">Siguiente</a></li>
            {/if}
        </ul>
    {/if}
    <p class="paginator-results">
        <i>Página {$page} de {$tot_elements} resultados</i><br>
    </p>
</div>