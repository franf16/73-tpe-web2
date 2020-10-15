{* Págiona con detalle de la sección *}
{include file="templates/headers.tpl" title=$seccion.nombre}

<body>

{include file="templates/nav.tpl"}

{include file="templates/seccion/seccion_view.tpl" seccion=$seccion noticias=$noticias}

{include file="templates/footer.tpl"}