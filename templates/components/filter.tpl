{* Filtro de búsqueda:
    - Uso: 
        + Definir $table (nombre de la tabla administrada)
        + Definir array $filter_search_fields con el formato [ 'nombreColumna1' => 'nombreMostradoEnHTML', ... ]
        + Definir array $filter_orders con el formato [ 'nombreColumna1' => 'nombreMostradoEnHTML', ... ]
    - Filtro desde aca los parámetros get del filtro (mal(?))
*}
{assign var="order_selected" value=(isset($smarty.get.order)) ? filter_input(INPUT_GET, 'order', FILTER_SANITIZE_STRING) : null}
{assign var="search_field_selected" value=(isset($smarty.get.search_field)) ? filter_input(INPUT_GET, 'search_field', FILTER_SANITIZE_STRING) : null}
{assign var="search_query" value=(isset($smarty.get.search_query)) ? filter_input(INPUT_GET, 'search_query', FILTER_SANITIZE_STRING) : null}
<form method="GET" class="filter">
    {if isset($filter_search_fields)}        
        <div class="filter-search">
            <div>
                <label>Buscar: </label>
                <input type="text" name="search_query" {if $search_query}value="{$search_query}"{/if}>
            </div>
            <div class="margin-lr-sm">
                <label>Campo: </label>
                <select name="search_field">
                    {foreach from=$filter_search_fields item=search_field_val key=search_field_key}
                        <option value="{$search_field_key}" {if $search_field_selected == $search_field_key}selected{/if}>{$search_field_val}</option>  
                    {/foreach}
                    {if !$search_query || !$search_field_selected}
                        <option hidden disabled selected></option>
                    {/if}
                </select>
            </div>
            <button type="submit" title="Buscar" class="btn-search"></button>
        </div>
    {/if}
    {if isset($filter_orders)}
        <div class="filter-order">
            <div class="margin-right-sm">
                <label>Ordenar por: </label>
                <select name="order">
                    <option hidden selected disabled></option>
                    {foreach from=$filter_orders item=order_val key=order_key}
                            <option value="{$order_key}" {if (isset($smarty.get.asc) || isset($smarty.get.desc)) && $order_selected == $order_key}selected{/if}>{$order_val}</option>  
                    {/foreach}
                </select>
            </div>
            <button type="submit" name="desc" value=1 title="Descendente" class="btn-arrowdown{if !empty($smarty.get.order) && isset($smarty.get.desc)} selected{/if}"></button>
            <button type="submit" name="asc" value=1 title="Ascendente" class="btn-arrowup{if !empty($smarty.get.order) && isset($smarty.get.asc)} selected{/if}"></button>
        </div>
    {/if}
</form>