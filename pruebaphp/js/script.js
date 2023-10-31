$("#search-icon").click(function() {
    $(".nav").toggleClass("search");
    $(".nav").toggleClass("no-search");
    $(".search-input").toggleClass("search-active");
});

$('.menu-toggle').click(function(){
    $(".nav").toggleClass("mobile-nav");
    $(this).toggleClass("is-active");
});

// para lo de ayuda
const items = document.querySelectorAll(".accordion button");

function toggleAccordion() {
const itemToggle = this.getAttribute('aria-expanded');

for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
}

if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
}
}

items.forEach(item => item.addEventListener('click', toggleAccordion));






// para poner un 'a' a mi img
var miImagen = document.getElementById('imgusuario');
// Agregamos un evento de clic a la imagen
miImagen.addEventListener('click', function() {
    // Redirigimos la página a "google.com" al hacer clic en la imagen
    window.location.href = 'http://167.172.137.234/moodleacatdemi/user/profile.php';
});

// pa abrir y recargar la pag actual
function abrirVentanaYRecargar() {
    // Abrir una nueva ventana pa salir
    var nuevaVentana = window.open("http://167.172.137.234/moodleacatdemi/login/logout.php?sesskey=Sdawna34sC", "_blank");

    // Recargar la página actual
    window.location.reload();
}











