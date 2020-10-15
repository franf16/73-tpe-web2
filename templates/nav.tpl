{* Nav de la aplicación.
    - Puede tener seteado el botón de la página actual
*}
{if !isset($selected)}
    {assign var="selected" value=null}
{/if}
<nav class="nav page-nav">
    <div>
        <button {if $selected == 'noticias'}class="selected"{/if}>
            <a {if $selected != 'noticias'}href="noticias"{/if}>Noticias</a>
        </button>
        <button {if $selected == 'secciones'}class="selected"{/if}>
            <a {if $selected != 'secciones'}href="secciones"{/if}>Secciones</a>
        </button>
    </div>
    <div>
        <form action="buscar" method="GET" class="buscador">
            <input type="text" name="q" {if isset($searchQuery)}value="{$searchQuery}"{/if} placeholder="Buscar noticias..." />
        </form>
    </div>
    <div>
        {if (!Auth::isLoggedIn())}
            <button {if $selected == 'login'}class="selected"{/if}>
                <a {if $selected != 'login'}href="login?redirect={THIS_URL}"{/if}>Login</a>
            </button>
        {else}
            <span class="margin-right-sm">Bienvenido <i>{Auth::getUsername()}</i></span>
            <button {if $selected == 'admin'}class="selected"{/if}>
                <a {if $selected != 'admin'}href="admin"{/if}>Administración</a>
            </button>
            <button>
                <a href="logout?redirect={THIS_URL}">Logout</a>
            </button>
        {/if}
    </div>
</nav>