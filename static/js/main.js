document.addEventListener('DOMContentLoaded', async () => {

    const URL_API = document.querySelector('base').href + 'api/';
    const URL_USUARIOS = URL_API + 'usuarios';

    console.log(
        await fetch(URL_USUARIOS).then(res => res.json())
    );
});