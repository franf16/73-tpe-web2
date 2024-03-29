{* Encabezado de la sección de administración:
    - Tiene seteado el botón de la página actual; si no hay una tabla seleccionada, está en la sección 'admin'
*}
{if !isset($selected)}
    {assign var="selected" value='admin'}
{/if}
{include '../nav.tpl' selected=$selected}
<h1>Administración</h1>
<nav class="nav">
    <button {if $selected == 'noticia'}class="selected"{/if}>
        <a {if $selected != 'noticia'}href="admin/noticia"{/if}>Administrar noticias</a>
    </button>
    <button {if $selected == 'seccion'}class="selected"{/if}>
        <a {if $selected != 'seccion'}href="admin/seccion"{/if}>Administrar secciones</a>
    </button>
    <button {if $selected == 'usuario'}class="selected"{/if}>
        <a {if $selected != 'usuario'}href="admin/usuario"{/if}>Administrar usuarios</a>
    </button>
</nav>