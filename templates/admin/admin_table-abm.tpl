{* Tabla ABM:
    - Uso: definir un array $elementKeys con los encabezados de las columnas a mostrar en la tabla [ 'col1', 'col2', ... ] 
    - Operaciones: editar y eliminar elemento por ID.
*}
<nav class="nav flex align-center">
    {if file_exists("templates/{$table}/{$table}_filter.tpl")} {* Si la tabla tiene implementado el filtro *}
        {include "templates/{$table}/{$table}_filter.tpl"} 
        {include "templates/components/filter.tpl"}
    {elseif !empty($elements)}
        {assign var="filter_orders" value=array_combine(array_keys($elements[0]), array_keys($elements[0]))}
        {assign var="filter_search_fields" value=array_combine(array_keys($elements[0]), array_keys($elements[0]))}
        {include "templates/components/filter.tpl"}
    {/if}
    <button title="Reset" class="btn-reset">
        <a href="{ADMIN}/{$table}"></a>
    </button>
</nav>
<table class="tabla">
    <thead>
        <tr>
            {foreach from=$elementKeys item=key}
                <th>{$key}</th>
            {/foreach}
            <th>acciones</th>
        </tr>
    </thead>
    <tbody>
        {if empty($elements)}
            <tr>
                <td colspan="{count($elementKeys)+1}">No se encontraron {$table}s</td>
            </tr>
        {else}
            {foreach from=$elements item=element}
                <tr>
                    {foreach from=$elementKeys item=key}
                        {strip}
                        <td>
                            {$element.$key}
                        </td>
                        {/strip}
                    {/foreach}
                    <td>
                        <button class="btn-edit" title="Editar">
                            <a href="editar/{$table}/{$element.id}"></a>
                        </button>
                        <button class="btn-delete" title="Eliminar">
                            <a href="eliminar/{$table}/{$element.id}"></a>
                        </button>
                    </td>
                </tr>
            {/foreach}
        {/if}
    </tbody>
</table>