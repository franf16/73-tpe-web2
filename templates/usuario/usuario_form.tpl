<form action="usuario{if isset($element.id)}/{$element.id}{/if}" method="POST">

    {if isset($element.id)} {* ¿abstraer formulario y aca cargar solo los campos? *}
        <h1>Editar {$table} <i>{$element.username}</i></h1>     
    {else}
        <h1>Agregar {$table}</h1>
    {/if}

    <div>
        <label for="username">Username *</label>
        <input type="text" name="username" maxlength="32" {if isset($element.username)}value="{$element.username}"{/if}>
    </div>
    <div>
        <label for="email">Email *</label>
        <input type="text" name="email" maxlength="64" {if isset($element.email)}value="{$element.email}"{/if}>
    </div>
    <div>
        <label for="password">Contraseña *</label>
        <input type="password" name="password">
    </div>
    <div>
        <label for="password_verify">Verificar contraseña *</label>
        <input type="password" name="password_verify">
    </div>
    <div class="flex">
        <input type="submit">
        {if isset($element.id)}
            <input type="reset">
        {/if}
    </div>
</form>