// PARA EL IDIOMA
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
            document.getElementById(idElemento).textContent = textoTraducido;
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
            autocomplete: "autocomplete",
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
            fo5: "fo6",
            fo5: "fo7",
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
            esp6: "esp6"


        };
        for (const id in elementosTraducibles) {
            if (elementosTraducibles.hasOwnProperty(id)) {
                const elementoHtml = document.getElementById(elementosTraducibles[id]);

                if (id === "buscar") {
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

            if (id === "buscar") {
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