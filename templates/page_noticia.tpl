{* Página con detalle de una noticia *}
{include file="templates/headers.tpl" title=$noticia.titulo|truncate:30:'...':true}
<script src="static/js/comentario.js"></script>
<body>

{include file="templates/nav.tpl"}

{include file="templates/noticia/noticia_view.tpl" noticia=$noticia}

{include './components/comentarios.tpl' idNoticia=$noticia.id}

{include file="templates/footer.tpl"}