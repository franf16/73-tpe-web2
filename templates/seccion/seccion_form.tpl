{* Formulario para agregar/editar una sección *}
<form action="seccion{if isset($element.id)}/{$element.id}{/if}" method="POST">
    <div>
        <label for="nombre">Nombre *</label>
        <input type="text" name="nombre" maxlength="32" {if isset($element.nombre)}value="{$element.nombre}"{/if}>
    </div>
    <div>
        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" cols="75" rows="5" maxlength="500">{if isset($element.descripcion)}{$element.descripcion}{/if}</textarea>
    </div>
    <div class="flex">
        <input type="submit">
        {if isset($element.id)}
            <input type="reset">
        {/if}
    </div>
</form>