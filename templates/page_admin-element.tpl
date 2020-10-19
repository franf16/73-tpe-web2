{* Página con el formulario para agregar/editar un elemento *}
{assign var="action" value=(isset($element.id)) ? "editar" : "agregar"}
{include file="templates/headers.tpl" title="{ucfirst($action)} {$table}"}

<body>

{include "./admin/admin_header.tpl" selected=$action}
{include "./admin/admin_panel-nav.tpl" selected=$action}

{include "./admin/admin_element.tpl" table=$table}

{include "templates/footer.tpl"}
