{* Página template *}
{include "./headers.tpl" title="Usuarios"}
<!-- <script src=""></script> -->
<body>

{include "./nav.tpl" selected="usuarios"}

<h1>Usuarios</h1>

{foreach from=$usuarios item=usuario}
    {include './usuario/usuario_view.tpl'}
{/foreach}

{include "./footer.tpl"}