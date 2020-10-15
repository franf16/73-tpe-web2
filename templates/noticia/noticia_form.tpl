{* Formulario para agregar/editar una noticia:
    - Puede recibir por GET el id_seccion 
*}
{if isset($smarty.get.id_seccion)}
    {assign var="id_seccion" value=filter_input(INPUT_GET, 'id_seccion', FILTER_VALIDATE_INT) scope=local}
{/if}
<form action="noticia{if isset($element.id)}/{$element.id}{/if}" method="POST">
    <div>
        <label for="titulo">Titulo *</label>
        <textarea name="titulo" cols="75" rows="2" maxlength="255">{if isset($element.titulo)}{$element.titulo}{/if}</textarea>
    </div>
    <div>
        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" cols="75" rows="5" maxlength="500">{if isset($element.descripcion)}{$element.descripcion}{/if}</textarea>
    </div>
    <div>
        <label for="texto">Texto</label>
        <textarea name="texto" cols="100" rows="25">{if isset($element.texto)}{$element.texto}{/if}</textarea>
    </div>
    <div>
        <label for="fecha">Fecha</label>
        <input type="datetime-local" name="fecha" {if isset($element.fecha)}value="{str_replace(' ', 'T', $element['fecha'])}"{/if}>
    </div>
    <div>
        <label for="id_seccion">Seccion *</label>
        <select name="id_seccion">
            {foreach from=$secciones item=seccion}{strip}
                <option value="{$seccion.id}" {if (isset($id_seccion) && $id_seccion == $seccion.id) || (isset($element.id_seccion) && $element.id_seccion === $seccion.id)}selected{/if}>
                    {$seccion.nombre}
                </option>
            {/strip}{/foreach}
        </select>
    </div>
    <div class="flex">
        <input type="submit">
        {if isset($element.id)}
            <input type="reset">
        {/if}
    </div>
</form>