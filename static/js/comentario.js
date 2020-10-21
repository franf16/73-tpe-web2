document.addEventListener('DOMContentLoaded', async () => {
    "use strict"

    const idNoticia = document.querySelector('#comentarios').dataset.idnoticia;
    const comentarios = await fetch(URL_API + 'comentarios/' + idNoticia).then(r => r.json());
    
    new Vue({
        el: '#comentarios',
        data: {
            comentarios
        },
        methods: {

        }
    });
    
    // console.log(comentarios);
    // for await (const comentario of comentarios) {
    //     console.log(comentario);
    // }
    
});