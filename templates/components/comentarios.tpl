<section id="comentarios" data-idnoticia={$idNoticia}>
    <h1>Comentarios</h1>
    
    {literal}
    
    <ul v-if="comentarios.length" class="lista">
        <li
        v-for="comentario of comentarios"
        :key="comentario.id"
        class="flex-col border"
        >
            <p class="flex space-between align-center padding border-bottom">
                <strong>{{ comentario.username }}</strong>
                <span>{{ comentario.fecha }}</span>
            </p>
            <p class="padding-left">{{ comentario.texto }} </p>
        </li>
    </ul>
    <p v-else class="padding">No hay comentarios</p>

    {/literal}
</section>