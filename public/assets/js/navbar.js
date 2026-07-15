document.addEventListener("DOMContentLoaded", function () {

    const navbar = document.querySelector(".navbar-home");

    if (!navbar) return;

    const activarNavbarScroll =
        document.body.classList.contains("body-sesion") ||
        document.body.classList.contains("body-tareas") ||
        document.body.classList.contains("body-distracciones") ||
        document.body.classList.contains("body-metricas");

    if (!activarNavbarScroll) return;

    function actualizarNavbar() {

        if (window.scrollY > 50) {
            navbar.classList.add("navbar-scroll");
        } else {
            navbar.classList.remove("navbar-scroll");
        }
    }

    actualizarNavbar();

    window.addEventListener("scroll", actualizarNavbar);

});