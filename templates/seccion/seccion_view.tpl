{* Detalle de item:
	- Información de la sección
	- Listado de noticias de la sección
*}
{if Auth::isLoggedIn()}
	{include '../admin/admin_element-nav.tpl' table='seccion' element=$seccion clases="justify-right inverted"}
{/if}
<h1>{$seccion.nombre} {if Auth::isLoggedIn()}<button class="btn-new margin-left-sm" title="Agregar noticia"><a href="agregar/noticia?id_seccion={$seccion.id}"></a></button>{/if}</h1>
{if (!empty($seccion.descripcion))}
    <p class="seccion-descripcion">{$seccion.descripcion}<hr></p>
{/if}
{if !empty($noticias)}
	<ul class="lista">
	    {foreach from=$noticias item=noticia}
	        <li>
	            {include file="templates/noticia/noticia_preview.tpl" noticia=$noticia}
	        </li>
	    {/foreach}
	</ul>
{else}
	<p class="padding">No hay noticias</p>		
{/if}
