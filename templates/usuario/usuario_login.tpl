{* Sección de login *}
{if !empty($errors)}
    <ul class="error">
        {foreach from=$errors item=error}{strip}
            <li>{$error}</li>
        {/strip}{/foreach}
    </ul>
{/if}
<form method="POST">
    <div>
        <label for="user">User: </label>
        <input type="text" name="user" />
    </div>
    <div>
        <label for="password">Password: </label>
        <input type="password" name="password" />
    </div>
    <input type="submit" />
</form>