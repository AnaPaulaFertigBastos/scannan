import 'bootstrap';


// Tema escuro / claro
document.addEventListener('DOMContentLoaded', () => {

    const body = document.getElementById('app-body');
    const button = document.getElementById('theme-toggle');

    const savedTheme =
        localStorage.getItem('theme') || 'light';

    body.classList.remove(
        'theme-light',
        'theme-dark'
    );

    body.classList.add(`theme-${savedTheme}`);

    button.innerHTML =
        savedTheme === 'dark'
            ? '<i id="theme-icon" class="bi bi-sun-fill text-light"></i>'
            : '<i id="theme-icon" class="bi bi-moon-fill"></i>';

      

    button.addEventListener('click', () => {

        const darkMode =
            body.classList.contains('theme-dark');

        body.classList.toggle('theme-dark');
        body.classList.toggle('theme-light');

        const newTheme =
            darkMode
                ? 'light'
                : 'dark';

        localStorage.setItem(
            'theme',
            newTheme
        );

        button.innerHTML =
            newTheme === 'dark'
                ? '<i id="theme-icon" class="bi bi-sun-fill text-light"></i>'
                : '<i id="theme-icon" class="bi bi-moon-fill"></i>';
    });
});

// Visualizar senha
window.mostrarSenha = function(id, botao)
{
    const campo = document.getElementById(id);

    if (campo.type === 'password') {
        campo.type = 'text';
        botao.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        campo.type = 'password';
        botao.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }
}