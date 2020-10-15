{* Detalle reducido de item *}
<article class="noticia-preview">
    {if Auth::isLoggedIn()}
        {include '../admin/admin_element-nav.tpl' table='noticia' element=$noticia clases='justify-right small'}
    {/if}
    <div class="noticia-preview__inner">
        <h1><a href="noticia/{$noticia.id}">{$noticia.titulo}</a></h1>
        <div class="noticia-info">
            <strong><a href="seccion/{$noticia.id_seccion}">{$noticia.seccion}</a></strong>
            <div>
                <i>● {$noticia.fecha}</i>
                <span class="margin-left">&#128065; {$noticia.visualizaciones}</span>
            </div>
        </div>
    </div>
</article>