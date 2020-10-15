{* Página con resultado de búsqueda con el buscador del nav *}
{include file="templates/headers.tpl" title="{$query} - Búsqueda"}
<body>
{include file="templates/nav.tpl" searchQuery=$query}

<div class="padding-left">
	<p>Resultados de <strong><i>{$query}</i></strong></p>
	<p>{$tot_resultados} resultado{if $tot_resultados > 1 || $tot_resultados == 0}s{/if}</p>
	<hr>
</div>

{if !empty($noticias)}
	<ul class="lista">
	    {foreach from=$noticias item=noticia}
	        <li>
	            {include file="templates/noticia/noticia_preview.tpl" noticia=$noticia}
	        </li>
	    {/foreach}
	</ul>
{else}
	<p class="padding">No se encontraron noticias</p>
{/if}

{include file="templates/footer.tpl"}