{* Página con detalle de una noticia *}
{include file="templates/headers.tpl" title=$noticia.titulo|truncate:30:'...':true}

<body>

{include file="templates/nav.tpl"}

{include file="templates/noticia/noticia_view.tpl" noticia=$noticia}

{include file="templates/footer.tpl"}