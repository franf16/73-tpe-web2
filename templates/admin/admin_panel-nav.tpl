<nav class="nav inverted align-center">
    <button class="btn-new {if $selected === 'agregar'}selected{/if}" title="Agregar">
        <a {if $selected !== 'agregar'}href="agregar/{$table}"{/if}></a>
    </button>
    <button {if $selected === $table}class="selected"{/if}>
        <a {if $selected !== $table}href="admin/{$table}"{/if}>Tabla</a>
    </button>
</nav>