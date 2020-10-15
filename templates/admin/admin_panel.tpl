{* Panel de administración:
    - Muestra una tabla con los elementos de la tabla seleccionada.
    - Muestra un filtro de búsqueda y/o ordenamiento si la tabla lo tiene implementado ('tableName/tableName_table.tpl').
*}
<section>
    <h1>Tabla {$table}</h1>
    <nav class="nav flex align-center">
        <button class="btn-new" title="Agregar">
            <a href="agregar/{$table}"></a>
        </button>
        {if file_exists("templates/{$table}/{$table}_filter.tpl")} {* Si la tabla tiene implementado el filtro *}
            {include "templates/{$table}/{$table}_filter.tpl"} 
            {include "templates/filter.tpl"} 
        {/if}
    </nav>
    {include "templates/{$table}/{$table}_table.tpl"} {* asigna variable $elementKeys (que atributos mostrar en la tabla) *}
    {include "./admin_table-abm.tpl" elements=$elements elementKeys=$elementKeys}
</section>