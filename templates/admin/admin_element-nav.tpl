{* Nav de administración de los elementos:
    - Operaciones: editar y eliminar.
    - Uso: 
        + definir $table (nombre de la tabla administrada) y $element (elemento administrado)
        + se puede definir un string $clases (clases extra del nav)
*}
<nav class="flex inverted {$clases}">
    <button class="btn-edit" title="Editar {$table}">
        <a href="editar/{$table}/{$element.id}"></a>
    </button>
    <button class="btn-delete" title="Eliminar {$table}">
        <a href="eliminar/{$table}/{$element.id}?redirect={THIS_URL}"></a>
    </button>
</nav>