{* Detalle de item *}
<article class="noticia">
    {if Auth::isLoggedIn()}
        {include '../admin/admin_element-nav.tpl' table='noticia' element=$noticia clases="justify-right inverted"}
    {/if}
    <h1 class="noticia-titulo">{$noticia.titulo}</h1>
    <p class="noticia-descripcion"><i>{$noticia.descripcion}</i></p>
    <hr>
    <div class="noticia-info">
        <strong><a href="seccion/{$noticia.id_seccion}">{$noticia.seccion}</a></strong>
        <div>
            <i>● {$noticia.fecha}</i>
            <span class="margin-left">&#128065; {$noticia.visualizaciones}</span>
        </div>
    </div>
    <hr>
    <p class="noticia-texto">{$noticia.texto|nl2br}</p>
</article>