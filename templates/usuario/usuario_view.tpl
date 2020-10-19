{* Detalle de item con nav para editar/borrar *}
{if Auth::isLoggedIn()}
	{include '../admin/admin_element-nav.tpl' table='usuario' element=$usuario clases="justify-right inverted"}
{/if}
<div class="flex-column text-center">
	<h3>{$usuario.username}</h3>
	<h3>{$usuario.email}</h3>
	<hr>
</div>