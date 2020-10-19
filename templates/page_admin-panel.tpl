{* Página con el panel de administación:
    - Puede tener definida una tabla o mostrar solo el nav de administración. 
*}
{include file="templates/headers.tpl" title="Administración $table"}

<body>

{include "./admin/admin_header.tpl" selected=$table}

{if isset($elements)}
    {include "./admin/admin_panel-nav.tpl" selected=$table}
    {include file="templates/admin/admin_panel.tpl" elements=$elements table=$table}
{/if}

{include file="templates/footer.tpl"}