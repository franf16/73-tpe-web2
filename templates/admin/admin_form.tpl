<form action="{$table}{if isset($element.id)}/{$element.id}{/if}" method="POST">

    {foreach from=$keys item=key}
        {if $key != 'id'}
            <div>
                <label for="{$key}">{ucfirst($key)} *</label>
                <input type="text" name="{$key}" {if isset($element.$key)}value="{$element.$key}"{/if}>
            </div>
        {/if}
    {/foreach}

    <div class="flex">
        <input type="submit">
        {if isset($element.id)}
            <input type="reset">
        {/if}
    </div>
</form>