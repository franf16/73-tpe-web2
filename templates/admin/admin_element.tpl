{* Sección con el formulario del elemento:
	- Uso: 
		+ La tabla tiene que implementar un formulario ('tableName/tableName_form.tpl')
		+ definir $element (elemento a administrar)
*}
<section>
	<h1>{(isset($element.id)) ? 'Editar' : 'Agregar'} {$table}</h1>

	{if isset($errors)}
	    <ul class="error">
	        {foreach from=$errors item=error}
	            <li>{$error}</li>
	        {/foreach}
	    </ul>
	{/if}

	{include file="templates/{$table}/{$table}_form.tpl" element=$element}
</section>