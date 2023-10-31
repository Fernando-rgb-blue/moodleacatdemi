<?php
    require_once('../config.php');
    global $CFG, $OUTPUT, $PAGE, $DB, $USER;
    $redirect = $CFG->wwwroot.'/pruebaphp/luis.php';

    // $PAGE->set_url('/test/payments.php');
    // $PAGE->set_pagelayout('popup');
    // echo $OUTPUT->header();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/ayuda.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js" defer></script>
    <title>Ayuda</title>
</head>
<body>
<header class="page-wrapper">
            <div class="nav-wrapper">
                <div class="grad-bar"></div>
                    <nav class="navbar">
                        <a><img src="que/cambiado.svg" id="logoHome" alt="Company Logo" class="lo"></a>
                        <div class="menu-toggle" id="mobile-menu">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </div>
                        <ul class="nav no-search">
                            <li class="nav-item" id="ocultar">
                                <img src="que/lupa.svg" height="20px" alt="" id="lupaImagen">
                                <input type="text" id="search-input" class="search-input" placeholder="Buscar curso...">
                                <ul id="suggestions" class="dropdown-content"></ul>
                            </li>
                            <li class="nav-item"><a href="#" id="cursos">Cursos</a></li>
                            <li class="nav-item"><a href="help.php" id="ayuda">Ayuda</a></li>
                            <li class="nav-item">
                                <div class="dropdown" id="idiomaDropdown">
                                    <a><span id="idioma">Idioma</span></a>
                                    <div class="dropdown-content">
                                        <div id="ingles" class="dropdown-option" onclick="cambiarIdioma('en')">Inglés</div>
                                        <div id="espanol" class="dropdown-option" onclick="cambiarIdioma('es')">Español</div>
                                        <!-- <div id="frances" class="dropdown-option" onclick="cambiarIdioma('fr')">Francés</div> -->
                                        <div id="portugues" class="dropdown-option" onclick="cambiarIdioma('pt')">Portugués</div>

                                    </div>
                                </div>
                            </li>

                            <!-- <li class="nav-item iniciar"><a id="iniciar" href="http://167.172.137.234/moodleacatdemi/Acatdemy/INICIO_SESION/index.html">Ingresar</a></li>
                            <li class="nav-item crear"><a id="registrarse" href="#">Registrarse</a></li> -->
                            <?php
                                if (!empty($USER->firstname) && !empty($USER->lastname)) {
                                    echo '<li class="nav-item iniciar">';
                                    echo '<a id="desloguear" href="" target="_blank" onclick="abrirVentanaYRecargar()">Salir sesión</a>';
                                    echo '</li>';
                                    echo '<li class="nav-item crear">';
                                    echo '<img src="que/usuario.svg" height="20px" alt="" id="imgusuario">';
                                    echo '<a href="http://167.172.137.234/moodleacatdemi/user/profile.php">';
                                    echo '<span>' . strtoupper(substr($USER->firstname, 0, 1)) . strtoupper(substr($USER->lastname, 0, 1)) . '</span>';
                                    echo '</a>';
                                    echo '</li>';
                                } else {
                                    echo '<li class="nav-item iniciar prim"><a id="iniciar" href="http://167.172.137.234/moodleacatdemi/Acatdemy/Inter_Inic_Sess/index.html">Ingresar</a></li>';
                                    echo '<li class="nav-item crear prim"><a id="registrarse" href="#">Registrarse</a></li>';
                                }
                            ?>
                            
                        </ul>
                    </nav>
                </div>
    </header>
    <main>
        <div class="relleno"></div>
        <!--Ayuda -->
        <section class="features headerayuda">
            <h3 class="ayudaheader" id="ayudaheader">Bienvenido al Centro de ayuda de Acatdemy</h3>
        </section>

        <div class="search-bar">
            <div class="container">
                <div class="input-bar">
                    <h4 class="tih4" id="tih4">Comience a escribir su consulta...</h4>
                    <input type="text" name="country" id="autocomplete" placeholder="¿Cómo podemos ayudarte? Ejm. cursos, cuenta, pagos ..."/>
                    <div id="no-encontrado-mensaje" style="display: none">❌ Palabra no encontrada</div>
                    <div class="autocomplete-suggestions" id="suggest"></div>
                </div>
            </div>
        </div>

        <div class="features fondoblanco">
            <div class="accordion">
                <div class="accordion-item">
                    <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">¿Como crear una cuenta en Acatdemy?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">¿Cómo son los cursos de Acatdemy?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">No encuentro mi curso en mi perfil</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">¿Cómo es el acceso a mi curso cuando lo compro?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                    </div>
                </div>
                <div class="accordion-item oculto">
                    <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">¿Los cursos tienen fecha de caducidad?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                    </div>
                </div>

                <div class="accordion-item oculto">
                    <button id="accordion-button-6" aria-expanded="false"><span class="accordion-title">¿Cómo me inscribo en un curso?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                    </div>
                </div>
                <div class="accordion-item oculto">
                    <button id="accordion-button-7" aria-expanded="false"><span class="accordion-title">¿Cuánto tiempo tengo para completar un curso?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                    </div>
                </div>
                <div class="accordion-item oculto">
                    <button id="accordion-button-8" aria-expanded="false"><span class="accordion-title">¿Puedo obtener un certificado al completar un curso?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                    </div>
                </div>
                <div class="accordion-item oculto">
                    <button id="accordion-button-9" aria-expanded="false"><span class="accordion-title">¿Qué tipo de soporte o ayuda puedo obtener durante el curso si tengo preguntas?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                    </div>
                </div>
                <div class="accordion-item oculto">
                    <button id="accordion-button-10" aria-expanded="false"><span class="accordion-title">Métodos de pago</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- contacta en redes sociales -->
        <div class="colorblanco">
            <section class="features">
                <div class="feature-container cuatropor ini">
                    <div class="center-content">
                        <h3 class="explora ti" id="explora">¿Tienes más dudas?</h3>
                        <p class="explora" id="accede">Contacta con nosotros en nuestras redes sociales</p>
                        <div class="iconosContacto">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            </ul>
                        </div>
                        <p class="explora" id="escribenos">o escríbenos a:</p>
                        <a href="mailto:acatdemy@demy.com" class="celeste" id="registrate">acatdemy@demy.com</a>
                    </div>
                </div>
                <div class="feature-container trespor ini">
                    <img src="imagenes/contactanos.png" alt="imágen de atencion al cliente" >
                </div>
            </section>    
        </div>


        <!-- descubre -->
        <section class="features descubre">
            <div class="feature-container sesentapor ini">
                <div class="center-content">
                    <h3 id="trad" class="explora ti blanco">Descubre por dónde comenzar</h3>
                    <p id="trad1" class="explora blanco">Realiza el test y descubre que cursos se adaptarían a ti.</p>
                    <a href="#" class="celeste test" id="test">Realizar Test</a>
                </div>
            </div>
        </section>
        
        <!-- ¿QUÉ ESPERAS DE UN CUSO DE ACATDEMY? -->
        <section class="features dos">
            <div class="feature-container cuatropor ini">
                <div class="center-content">
                    <h3 class="explora ti" id="que_es">¿QUÉ ESPERAS DE UN CUSO DE ACATDEMY?</h3>
                </div>
            </div>
        </section>  
        <section class="esperas">
            <div class="columna1">
                <div class="cont">
                    <img src="que/q1.svg" alt="" height="40px">
                    <div>
                        <p><b id="esperar1">Cursos de alta calidad</b></p>
                        <p id="esp1">Encontrarás cursos de alta calidad y que están actualizados con las últimas tendencias tecnológicas.</p>
                    </div>
                </div>
                <div class="cont">
                    <img src="que/q2.svg" alt="" height="40px">
                    <div>
                        <p><b id="esperar2">Impartidos por expertos</b></p>
                        <p id="esp2">Los instructores son expertos en sus campos y tienen experiencia real en la industria de la informática y la tecnología.</p>
                    </div>
                </div>
                <div class="cont">
                    <img src="que/q3.svg" alt="" height="40px">
                    <div>
                        <p><b id="esperar3">Flexibilidad</b></p>
                        <p id="esp3">Los cursos ofrecen flexibilidad para que los estudiantes puedan aprender a su propio ritmo y acceder al contenido desde cualquier lugar y en cualquier momento.</p>
                    </div>
                </div>
            </div>
            <div class="columna2">
                <div class="cont">
                    <img src="que/q4.svg" alt="" height="40px">
                    <div>
                        <p><b id="esperar4">Son evaluativos</b></p>
                        <p id="esp4">Los cursos incluyen evaluaciones y retroalimentación regular para medir el progreso y garantizar un aprendizaje efectivo</p>
                    </div>
                </div>
                <div class="cont">
                    <img src="que/q5.svg" alt="" height="40px">
                    <div>
                        <p><b id="esperar5">Interactividad</b></p>
                        <p id="esp5">Los estudiantes pueden participar en actividades interactivas, discusiones y proyectos colaborativos para mejorar su comprensión y habilidades.</p>
                    </div>
                </div>
                <div class="cont">
                    <img src="que/q6.svg" alt="" height="40px">
                    <div>
                        <p><b id="esperar6">Conseguir certificado</b></p>
                        <p id="esp6">Por cada curso completado obtienes un certificado personalizado y firmado por el profesor.
                        </p>
                    </div>
                </div>
            </div>
        </section>    

    </main>
    <footer>
        <div class="footer">

            <div class="row reser">
                <ul>
                    <li id="fo1">© 2023 Acatdemy Todos los derechos reservadoss</li>
                <ul>
            </div>
            
            <div class="row">
                <ul>
                    <li id="fo2"><a href="index.html#nosotros">Sobre nosotros</a></li>
                    <li id="fo3"><a href="#">Cursos</a></li>
                    <li id="fo4"><a href="#">Términos y condiciones</a></li>
                    <li id="fo5"><a href="cookies.html">Políticas sobre cookies</a></li>
                    <li id="fo6"><a href="#">Contáctanos</a></li>
                    <li id="fo7"><a href="help.html">Ayuda</a></li>
                </ul>
            </div>
            
            <div class="row iconos">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                </ul>
            </div>
        </div>
    </footer>                    
        <script>

            // inicio de busqueda
            // Array de opciones de sugerencias
            const opciones = ["programacion en python", "redes y topologias", "switch"];
            const lupaImagen = document.getElementById("lupaImagen");

            // Maneja el clic en la imagen de la lupa
            lupaImagen.addEventListener("click", function () {
                const searchInput = document.getElementById("search-input");

                // Activa el input de búsqueda y enfócalo
                searchInput.classList.add("search-active");
                searchInput.focus();
            });
            // Función para mostrar sugerencias
            function mostrarSugerencias(inputValue) {
                const suggestions = opciones.filter((opcion) =>
                    opcion.toLowerCase().includes(inputValue.toLowerCase())
                );

                const suggestionsList = document.getElementById("suggestions");

                // Limpia la lista de sugerencias previas
                suggestionsList.innerHTML = "";

                // Calcula la posición y el ancho de la barra de búsqueda
                const searchInput = document.getElementById("search-input");
                const inputRect = searchInput.getBoundingClientRect();
                const inputWidth = inputRect.width;
                const inputTop = inputRect.bottom;

                // Actualiza la posición de la lista de sugerencias
                suggestionsList.style.width = inputWidth + "px";
                suggestionsList.style.top = inputTop + "px";
                suggestionsList.style.left = inputRect.left + "px";

                // Muestra u oculta la lista de sugerencias según si hay coincidencias
                if (inputValue.length > 0 && suggestions.length > 0) {
                    // Agrega las sugerencias coincidentes a la lista
                    suggestions.forEach((suggestion) => {
                    const listItem = document.createElement("li");
                    listItem.textContent = suggestion;
                    listItem.classList.add("dropdown-option");
                    suggestionsList.appendChild(listItem);
                    });

                    suggestionsList.style.display = "block";
                } else if(inputValue.length === 0) {
                        suggestionsList.style.display = "none"; // Oculta la lista si está vacío
                }else {
                // Si no hay coincidencias, muestra el mensaje "Curso no encontrado"
                const listItem = document.createElement("li");
                listItem.textContent = "Curso no encontrado";
                listItem.classList.add("dropdown-option");
                suggestionsList.appendChild(listItem);
                suggestionsList.style.display = "block";
                }
            }

            // Función para manejar el redireccionamiento
            function redirigirURL(url) {
                window.location.href = url;
            }

            // Maneja el clic en una sugerencia para llenar la barra de búsqueda
            document.getElementById("suggestions").addEventListener("click", function (event) {
                const clickedSuggestion = event.target.textContent;
                this.style.display = "none";

                switch (clickedSuggestion) {
                    case "Curso no encontrado":
                    // Aquí puedes manejar el comportamiento personalizado para "Curso no encontrado"
                    // Por ejemplo, mostrar un mensaje de error o realizar otra acción.
                    break;
                    case "redes y topologias":
                    // Redirige al usuario a cursos.html
                    redirigirURL("cursos.html");
                    break;
                    case "switch":
                    // Redirige al usuario a home.html
                    redirigirURL("home.html");
                    break;
                    case "programacion en python":
                    // Redirige al usuario a google.com
                    redirigirURL("https://www.google.com");
                    break;
                    default:
                    // Por defecto, redirige al usuario a home.html
                    redirigirURL("home.html");
                }
            });

            // Maneja el evento de cambio en el input de búsqueda
            document.getElementById("search-input").addEventListener("input", function () {
                const inputValue = this.value;
                mostrarSugerencias(inputValue);
            });

            // Cerrar la lista de sugerencias si se hace clic en cualquier lugar fuera de ella
            document.addEventListener("click", function (event) {
                if (!event.target.closest(".search-input")) {
                    document.getElementById("suggestions").style.display = "none";
                }
            });
            // fin de busqueda

            // para poner un 'a' a mi img del logo
            var miImagen2 = document.getElementById('logoHome');

            // Agregamos un evento de clic a la imagen
            miImagen2.addEventListener('click', function() {
                // Redirigimos la página a "google.com" al hacer clic en la imagen
                window.location.href = 'index.php';
            });

            
            // inicio de busqueda de ayuda
            // Función para mostrar u ocultar elementos del acordeón según la búsqueda
            function filtrarAcordeon(inputValue) {
                const accordionItems = document.querySelectorAll(".accordion-item");
                const noEncontradoMensaje = document.getElementById("no-encontrado-mensaje");

                let encontrado = false;

                accordionItems.forEach(item => {
                    const contenido = item.querySelector(".accordion-title").textContent.toLowerCase();
                    const esOculto = item.classList.contains("oculto");
                    
                    // Si el elemento no es oculto y su título contiene el texto de búsqueda, se muestra; de lo contrario, se oculta.
                    if (contenido.includes(inputValue.toLowerCase())) {
                        item.style.display = "block";
                        encontrado = true;
                    } else {
                        item.style.display = "none";
                    }
                });

                // Mostrar el mensaje "palabra no encontrada" si no se encontraron coincidencias
                if (!encontrado) {
                    noEncontradoMensaje.style.display = "block";
                } else {
                    noEncontradoMensaje.style.display = "none";
                }
            }

            // Maneja el evento de cambio en el input de búsqueda
            document.getElementById("autocomplete").addEventListener("input", function () {
                const inputValue = this.value;
                filtrarAcordeon(inputValue);
            });

            // Cargar el acordeón al inicio de la página
            filtrarAcordeon("");
            // Fin de busqueda de ayuda

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
                    trad: "trad",
                    trad1: "trad1",
                    test: "test",
                    que_es: "que_es",
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
                    fo1: "fo1",
                    fo2: "fo2",
                    fo3: "fo3",
                    fo4: "fo4",
                    fo5: "fo5",
                    fo6: "fo6",
                    fo7: "fo7"
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
            }
        
        </script>
</body>
</html>
