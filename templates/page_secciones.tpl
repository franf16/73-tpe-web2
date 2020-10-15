{* Página con las secciones *}
{include file="templates/headers.tpl" title="Secciones"}
<body>

{include file="templates/nav.tpl" selected='secciones'}

<h1>Secciones{if Auth::isLoggedIn()}<button class="btn-new margin-left-sm" title="Agregar seccion"><a href="agregar/seccion"></a></button>{/if}</h1>
<ul class="lista">
    {foreach from=$secciones item=seccion}
        <li>
            {include file="templates/seccion/seccion_preview.tpl" seccion=$seccion}
        </li>
    {/foreach}
</ul>

{include file="templates/footer.tpl"}