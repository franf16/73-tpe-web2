{* Sección con el formulario del elemento:
	- Uso: 
		+ La tabla tiene que implementar un formulario ('tableName/tableName_form.tpl')
		+ definir $element (elemento a administrar)
*}
<section>
	{if isset($errors)}
	    <ul class="error">
	        {foreach from=$errors item=error}
	            <li>{$error}</li>
	        {/foreach}
	    </ul>
	{/if}

	{if file_exists("templates/{$table}/{$table}_form.tpl")}
		{include file="templates/{$table}/{$table}_form.tpl" element=$element}
	{else}
		{include file="./admin_form.tpl" keys=$keys}
	{/if}
</section>