const icon_menu = document.getElementById ('menu'),
    header = document.querySelector ('.header'),
    main = document.querySelector ('.main'),
    sidebar = document.getElementById ('sidebar');

icon_menu.addEventListener ('click', action_sidebar);

/* Abrir o cerrar la barra de navegación */
function action_sidebar(){
    sidebar.classList.toggle ('is-sidebar-active');
    header.classList.toggle ('is-header-active');
    main.classList.toggle ('is-main-active');
}