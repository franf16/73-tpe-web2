{* Página de inicio:
    - Listado de noticias ordenados por más recientes
*}
{include file="templates/headers.tpl" title="Home"}
<!-- <script src=""></script> -->
<body>
{include file="templates/nav.tpl" selected='noticias'}

<h1>Noticias{if Auth::isLoggedIn()}<button class="btn-new margin-left-sm" title="Agregar noticia"><a href="agregar/noticia"></a></button>{/if}</h1>

<ul class="lista">
    {foreach from=$noticias item=noticia}
        <li>
            {include file="templates/noticia/noticia_preview.tpl" noticia=$noticia}
        </li>
    {/foreach}
</ul>

{* {include './components/paginator.tpl'} *}

{include file="templates/footer.tpl"}

{* Ideas para home:

    *** Templates con estructuras de base. ej: [
    *    - sección principal con 1 noticia vertical y 2 horizontales
    *    - sección secundaria de noticias
    *    - sección de videos
    *    - publicidad entre secciones ]
    * el admin define que artículos van en la sección principal, 
    * que/cuantas secciones secundarias hay, etc (guardar los datos en una tabla en la db?)

    *** Bloques
    * el admin puede agregar bloques a la home
    * un bloque es un archivo.tpl con logica propia para mostrar el contenido
    * el controlador que llama a la home asigna las variables que se necesitan para mostrar el contenido
    * falta relacionar voluntariamente las noticias a los bloques (click a btn editar noticia del bloque y asignar el id de la noticia)
    * ¿ donde se guardan esas relaciones ?
*}