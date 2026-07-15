document.addEventListener("DOMContentLoaded", () => {
    const botonMenu = document.getElementById("menu-toggle");
    const menuMobile = document.getElementById("nav-mobile");

    if (botonMenu && menuMobile) {
        botonMenu.addEventListener("click", () => {
            menuMobile.classList.toggle("activo");
            botonMenu.textContent = menuMobile.classList.contains("activo") ? "×" : "☰";
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const botonesModal = document.querySelectorAll("[data-modal]");
    const botonesCerrar = document.querySelectorAll(".cerrar-modal");

    botonesModal.forEach((boton) => {
        boton.addEventListener("click", () => {
            const modal = document.getElementById(boton.dataset.modal);

            if (modal) {
                modal.classList.add("activo");
            }
        });
    });

    botonesCerrar.forEach((boton) => {
        boton.addEventListener("click", () => {
            boton.closest(".modal").classList.remove("activo");
        });
    });
});