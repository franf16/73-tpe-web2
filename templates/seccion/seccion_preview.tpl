{* Detalle reducido de item *}
<article class="seccion-preview">
    {if Auth::isLoggedIn()}
        {include '../admin/admin_element-nav.tpl' table='seccion' element=$seccion clases="small justify-right inverted"}
    {/if}
    <div class="seccion-preview__inner">
        <h1><a href="seccion/{$seccion.id}">{$seccion.nombre}</a></h1>
    </div>
</article>