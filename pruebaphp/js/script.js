// para agregar un idmiId
// Obtén el elemento con la clase 'luz' y agrega un id
var elementoConClaseLogin = document.querySelector('.login-heading.mb-4');
if (elementoConClaseLogin) {
    elementoConClaseLogin.id = 'miId';
}

var enlaceOlvidoContrasena = document.querySelector('a[href="http://localhost/moodleacatdemi/login/forgot_password.php"]');
if (enlaceOlvidoContrasena) {
    enlaceOlvidoContrasena.id = 'OlvidoContrasena';
}

var inputContrasena = document.getElementById('password');
if (inputContrasena) {
    inputContrasena.placeholder = 'Password';
}

var inputUser = document.getElementById('username');
if (inputUser) {
    inputUser.placeholder = 'User';
}

// pal forgotpassword


var recuperar = document.querySelector('.box.py-3.generalbox.boxwidthnormal.boxaligncenter');
if (recuperar) {
    recuperar.textContent = 'Para reajustar su contraseña, envíe su nombre de usuario o su dirección de correo electrónico, si podemos encontrarlo en la base de datos, le enviaremos un email con instrucciones para poder acceder de nuevo.';
    recuperar.id = 'Parareajustar';
}



// Obtén todos los elementos con la clase específica
var elementosMismaClase = document.querySelectorAll('.d-flex.align-self-stretch.align-items-center.mb-0');

// Itera sobre los elementos y asigna un id al que tiene el texto específico
elementosMismaClase.forEach(function(elemento) {
    if (elemento.textContent.trim() === 'aasdasdasdaa') {
        elemento.textContent = 'Buscar por usuario';
        elemento.id = 'fondoestilo1';
    }
    else if(elemento.textContent.trim() === 'Buscar por dirección email') {
        elemento.id = 'fondoestilo';
    }
});


// para el a de regresar
// Crea el enlace dinámicamente
var enlace = document.createElement('a');
enlace.id = 'regresar';
enlace.href = '../login/index.php';
enlace.className = 'celeste';
enlace.textContent = 'Regresar';

// Agrega el enlace al cuerpo del documento
document.body.appendChild(enlace);



// var h3Elemento = document.querySelector('.d-flex.align-self-stretch.align-items-center.mb-0');
// if (h3Elemento) {
//     h3Elemento.textContent = 'Buscar por usuario';
// }


// var divElemento = document.querySelector('.d-flex.align-self-stretch.align-items-center.mb-0');
// if (divElemento) {
//     divElemento.id = 'fondoestilo';
// }










// PARA EL IDIOMA TermsAndConditions.
function traducirPlaceholder(idElemento, idioma) {
    const placeholderOriginal = document.getElementById(idElemento).getAttribute("placeholder");
    const urlTraduccion = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${idioma}&dt=t&q=${encodeURIComponent(placeholderOriginal)}`;

    fetch(urlTraduccion)
        .then(response => response.json())
        .then(data => {
            const placeholderTraducido = data[0][0][0];
            document.getElementById(idElemento).setAttribute("placeholder", placeholderTraducido);
        })
        .catch(error => {
            console.error(`Error al traducir el placeholder de ${idElemento}:`, error);
        });
}

function traducirElemento(idElemento, idioma) {
    const textoOriginal = document.getElementById(idElemento).textContent;
    const urlTraduccion = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${idioma}&dt=t&q=${encodeURIComponent(textoOriginal)}`;

    fetch(urlTraduccion)
        .then(response => response.json())
        .then(data => {
            const textoTraducido = data[0][0][0];
            if ( (idElemento == 'ayuda' || idElemento == 'fo7') && idioma == 'en'){
                document.getElementById(idElemento).textContent = 'Help';
            }else if ( idElemento == 'iniciar' && idioma == 'en'){
                document.getElementById(idElemento).textContent = 'Login';
            }else if ( idElemento == 'cursos' && idioma == 'en'){
                document.getElementById(idElemento).textContent = 'Courses';
            }else if ( idElemento == 'cursos' && idioma == 'pt'){
                document.getElementById(idElemento).textContent = 'Cursos';
            } else{
                document.getElementById(idElemento).textContent = textoTraducido;
            }
            
        })
        .catch(error => {
            console.error(`Error al traducir ${idElemento}:`, error);
        });
}

function cambiarIdioma(idioma) {
    if (idioma === 'es') {
        localStorage.removeItem('idiomaSeleccionado'); // Borra la preferencia guardada

        // Recarga la página para cargar el HTML original
        window.location.reload();
    } else {
        const elementosTraducibles = {
            cursos: "cursos",
            ayuda: "ayuda",
            buscar: "search-input",
            idioma: "idioma",
            espanol: "espanol",
            portugues: "portugues",
            ingles: "ingles",
            iniciar: "iniciar",
            desloguear: "desloguear",
            registrarse: "registrarse",
            ayudaheader: "ayudaheader",
            tih4: "tih4",
            noencontrado: "no-encontrado-mensaje",
            somos: "somos",
            mas: "mas",
            descubre: "descubre", 
            bton1: "accordion-button-1",
            bton2: "accordion-button-2",
            bton3: "accordion-button-3",
            bton4: "accordion-button-4",
            bton5: "accordion-button-5",
            bton6: "accordion-button-6",
            bton7: "accordion-button-7",
            bton8: "accordion-button-8",
            bton9: "accordion-button-9",
            bton10: "accordion-button-10",
            accede: "accede",
            explora: "explora",
            escribenos: "escribenos",
            registrate: "registrate",
            descubre2: "descubre2",
            fo1: "fo1",
            fo2: "fo2",
            fo3: "fo3",
            fo4: "fo4",
            fo5: "fo5",
            fo6: "fo6",
            fo7: "fo7",
            sobre: "sobre",
            n1: "n1",
            n2: "n2",
            n3: "n3",
            cont1n: "cont1n",
            cont12n: "cont12n",
            cont13n: "cont13n",
            cont2n: "cont2n",
            cont21n: "cont21n",
            cont22n: "cont22n",
            cont23n: "cont23n",
            cont3n: "cont3n",
            que_es: "que_es",
            nomc1: "nomc1",
            nomc2: "nomc2",
            nomc3: "nomc3",
            nomc4: "nomc4",
            nomc5: "nomc5",
            nomc6: "nomc6",
            creador1: "creador1",
            contC1: "contC1",
            contenido1: "contenido1",
            horas1: "horas1",
            ir1: "ir1",
            creador2: "creador2",
            contC2: "contC2",
            contenido2: "contenido2",
            horas2: "horas2",
            ir2: "ir2",
            creador3: "creador3",
            contC3: "contC3",
            contenido3: "contenido3",
            horas3: "horas3",
            ir3: "ir3",
            creador4: "creador4",
            contC4: "contC4",
            contenido4: "contenido4",
            horas4: "horas4",
            ir4: "ir4",
            creador5: "creador5",
            contC5: "contC5",
            contenido5: "contenido5",
            horas5: "horas5",
            ir5: "ir5",
            creador6: "creador6",
            contC6: "contC6",
            contenido6: "contenido6",
            horas6: "horas6",
            ir6: "ir6",
            vercursos: "vercursos",
            trad: "trad",
            trad1: "trad1",
            test: "test",
            esperar1: "esperar1",
            esp1: "esp1",
            esperar2: "esperar2",
            esp2: "esp2",
            esperar3: "esperar3",
            esp3: "esp3",
            esperar4: "esperar4",
            esp4: "esp4",
            esperar5: "esperar5",
            esp5: "esp5",
            esperar6: "esperar6",
            esp6: "esp6",
            Terbi1: "Terbi1",
            Terbi2: "Terbi2",
            Terbi3: "Terbi3",
            ryp0: "ryp0",
            ryp1: "ryp1",
            ryp2: "ryp2",
            ryp3: "ryp3",
            ryp4: "ryp4",
            iyp0: "iyp0",
            iyp1: "iyp1",
            iyp2: "iyp2",
            iyp3: "iyp3",
            iyp4: "iyp4",
            upc0: "upc0",
            upc1: "upc1",
            upc2: "upc2",
            upc3: "upc3",
            pi0: "pi0",
            pi1: "pi1",
            pi2: "pi2",
            r0: "r0",
            r1: "r1",
            r2: "r2",
            r3: "r3",
            ctc0: "ctc0",
            ctc3: "ctc3",
            ctc2: "ctc2",
            ctc1: "ctc1",
            tdc0: "tdc0",
            tdc1: "tdc1",
            cn0: "cn0",
            cn1: "cn1",
            miId: "miId",
            loginguestbtn: "loginguestbtn",
            loginbtn: "loginbtn",
            OlvidoContrasena: "OlvidoContrasena",
            fondoestilo: "fondoestilo",
            fondoestilo1: "fondoestilo1",
            Parareajustar: "Parareajustar",
            id_username_label: "id_username_label",
            id_email_label: "id_email_label",
            id_submitbuttonusername: "id_submitbuttonusername",
            regresar: "regresar",
            autocomplete: "autocomplete",
            

        };
        for (const id in elementosTraducibles) {
            if (elementosTraducibles.hasOwnProperty(id)) {
                const elementoHtml = document.getElementById(elementosTraducibles[id]);

                if (id === "buscar" || id === "autocomplete") {
                    traducirPlaceholder(elementosTraducibles[id], idioma);
                } else if (elementoHtml) {
                    traducirElemento(elementosTraducibles[id], idioma);
                }
            }
        }
        localStorage.setItem('idiomaSeleccionado', idioma);
    }
}

// Función para traducir elementos según el idioma seleccionado
function traducirSegunIdioma(idiomaSeleccionado) {

    // Iterar a través de los elementos y traducir según el idioma seleccionado
    for (const id in elementosTraducibles) {
        if (elementosTraducibles.hasOwnProperty(id)) {
            const elementoHtml = document.getElementById(elementosTraducibles[id]);

            if (id === "search-input" || id === "autocomplete") {
                traducirPlaceholder(elementosTraducibles[id], idiomaSeleccionado);
            } else if (elementoHtml) {
                traducirElemento(elementosTraducibles[id], idiomaSeleccionado);
            }
        }
    }
}

// Obtener el idioma seleccionado al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const idiomaGuardado = localStorage.getItem('idiomaSeleccionado');
    
    if (idiomaGuardado) {
        cambiarIdioma(idiomaGuardado);
        traducirSegunIdioma(idiomaGuardado);
    }
});








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








