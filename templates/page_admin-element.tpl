{* Página con el formulario para agregar/editar un elemento *}
{include file="templates/headers.tpl" title={(isset($element.id)) ? "Editar $table {$element.id}" : "Agregar $table"}}

<body>

{include file="templates/admin/admin_header.tpl" selected='elementForm'}

{include file="templates/admin/admin_element.tpl" table=$table}

{include file="templates/footer.tpl"}