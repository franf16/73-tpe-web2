{* Tabla ABM:
    - Uso: definir un array $elementKeys con los encabezados de las columnas a mostrar en la tabla [ 'col1', 'col2', ... ] 
    - Operaciones: editar y eliminar elemento por ID.
*}
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