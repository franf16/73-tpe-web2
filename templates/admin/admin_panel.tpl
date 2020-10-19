{* Panel de administración:
    - Muestra una tabla con los elementos de la tabla seleccionada.
    - Muestra un filtro de búsqueda y/o ordenamiento si la tabla lo tiene implementado ('tableName/tableName_table.tpl').
*}
<section>

    {if file_exists("templates/{$table}/{$table}_table.tpl")} {* Si la tabla tiene implementado la tabla *}
        {include "templates/{$table}/{$table}_table.tpl"} {* asigna variable $elementKeys (que atributos mostrar en la tabla) *}
    {/if}
    {include "./admin_table-abm.tpl" elements=$elements elementKeys=(isset($elementKeys)) ? $elementKeys : array_keys($elements[0])}
    {include "templates/components/paginator.tpl"}
</section>