<?php
    require_once('../config.php');
    global $CFG, $OUTPUT, $PAGE, $DB, $USER;
    $redirect = $CFG->wwwroot.'/pruebaphp/cookies.php';

    $resultados = $DB->get_records_sql("SELECT DISTINCT titulo FROM {cursosp}"); 
    // Crear un array asociativo en PHP
    $ocursos = [];
    $posi = 0;
    foreach ($resultados as $resultado) {
        $ocursos[$posi] = $resultado->titulo;
        $posi++;
    }
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
    <title>Cookies | Acatdemy</title>
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
                            <li class="nav-item"><a href="../index.php" id="cursos">Cursos</a></li>
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
                                if (!empty($USER->firstname) && !empty($USER->lastname) && strtoupper(substr($USER->firstname, 0, 1)) !='&' && strtoupper($USER->firstname) !='INVITADO') {
                                    echo '<li class="nav-item iniciar">';
                                    echo '<a id="desloguear" href="" target="_blank" onclick="abrirVentanaYRecargar()">Salir sesión</a>';
                                    echo '</li>';
                                    echo '<li class="nav-item crear">';
                                    echo '<img src="que/usuario.svg" height="20px" alt="" id="imgusuario">';
                                    echo '<a href="../user/profile.php">';
                                    echo '<span>' . strtoupper(substr($USER->firstname, 0, 1)) . strtoupper(substr($USER->lastname, 0, 1)) . '</span>';
                                    echo '</a>';
                                    echo '</li>';
                                } else {
                                    echo '<li class="nav-item iniciar prim"><a id="iniciar" href="../login/index.php">Ingresar</a></li>';
                                    echo '<li class="nav-item crear prim"><a id="registrarse" href="../login/signup.php">Registrarse</a></li>';
                                }
                            ?>
                            
                        </ul> 
                    </nav>
                </div>
    </header>
    <main>
        <div class="relleno"></div>
        <!-- esto esta para q no haya error en la hora de traducir -->
        <input type="text" name="country" id="autocomplete" placeholder="¿Cómo podemos ayudarte? Ejm. cursos, cuenta, pagos ..." style="display: none">                        


        <!--cookies -->
        <section class="features headerayuda">
            <h3 class="ayudaheader" id="ayudaheader">Políticas sobre cookies</h3>
        </section>
        <section class="esperas">
            <div class="columna1">
                <div class="cont">
                    <div>
                        
                        <p>
                            <span>El propósito de nuestra Política de Cookies es brindarte una explicación detallada y transparente sobre cómo funcionan las cookies en nuestro sitio web,</span>
                            <a href="#" class="celeste"> www.acatdemy.comm</a>
                            <span> Si deseas obtener información adicional acerca de las cookies, no dudes en contactarnos enviando un correo electrónico a </span>
                            <a href="mailto:acatdemy@demy.com" class="celeste" id="registrate">acatdemy@demy.com</a>
                            <span>. Esta política tiene como objetivo informar a los usuarios sobre el uso de cookies en la plataforma web y proporcionar una vía de contacto para aquellos que deseen obtener más detalles o aclaraciones sobre este tema.</span>

                        </p><br><br>

                        <p class="negrita"><b id="esperar1">Cookies</b></p><br>
                        <p>
                            <span>Las cookies son pequeños archivos de texto que los sitios web guardan en tu computadora cuando los visitas. </span>
                            <span>Estos archivos contienen información sobre tu interacción con el sitio y se utilizan para recordar cosas como tus preferencias, inicio de sesión y otros datos relacionados con tu visita al sitio. </span>
                            <span>Las cookies ayudan a mejorar tu experiencia en línea al permitir que los sitios recuerden quién eres y lo que te interesa. </span>
                            <span>Nosotros no almacenamos información sensible de identificación personal como tu dirección, contraseña, los datos de tu tarjeta de crédito o débito, etc. en las cookies que utilizamos.
                            </span>
                            
                        </p><br><br>
                        
                        <p class="negrita"><b id="esperar1">Clases de cookies</b></p><br>
                        <p>
                            <span>Nuestra Plataforma utiliza cookies propias y de terceros con diferentes finalidades, concretamente: </span>
                            <br><br>
                            <p><b>Cookies propias</b></p>
                            <p><b>Cookies de terceross</b></p>

                            
                        </p><br><br>
                    </div>
                </div>
            </div>
            </div>
        </section>  


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
                        <p class="negrita"><b id="esperar1">Cursos de alta calidad</b></p>
                        <p id="esp1">Encontrarás cursos de alta calidad y que están actualizados con las últimas tendencias tecnológicas.</p>
                    </div>
                </div>
                <div class="cont">
                    <img src="que/q2.svg" alt="" height="40px">
                    <div>
                        <p class="negrita"><b id="esperar2">Impartidos por expertos</b></p>
                        <p id="esp2">Los instructores son expertos en sus campos y tienen experiencia real en la industria de la informática y la tecnología.</p>
                    </div>
                </div>
                <div class="cont">
                    <img src="que/q3.svg" alt="" height="40px">
                    <div>
                        <p class="negrita"><b id="esperar3">Flexibilidad</b></p>
                        <p id="esp3">Los cursos ofrecen flexibilidad para que los estudiantes puedan aprender a su propio ritmo y acceder al contenido desde cualquier lugar y en cualquier momento.</p>
                    </div>
                </div>
            </div>
            <div class="columna2">
                <div class="cont">
                    <img src="que/q4.svg" alt="" height="40px">
                    <div>
                        <p class="negrita"><b id="esperar4">Son evaluativos</b></p>
                        <p id="esp4">Los cursos incluyen evaluaciones y retroalimentación regular para medir el progreso y garantizar un aprendizaje efectivo.</p>
                    </div>
                </div>
                <div class="cont">
                    <img src="que/q5.svg" alt="" height="40px">
                    <div>
                        <p class="negrita"><b id="esperar5">Interactividad</b></p>
                        <p id="esp5">Los estudiantes pueden participar en actividades interactivas, discusiones y proyectos colaborativos para mejorar su comprensión y habilidades.</p>
                    </div>
                </div>
                <div class="cont">
                    <img src="que/q6.svg" alt="" height="40px">
                    <div>
                        <p class="negrita"><b id="esperar6">Conseguir certificado</b></p>
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
                    <li><a href="index.php#nosotros" id="fo2">Sobre nosotros</a></li>
                    <li><a href="../index.php" id="fo3">Cursos</a></li>
                    <li><a href="TermsAndConditions.php" id="fo4">Términos y Condiciones</a></li>
                    <li><a href="cookies.php" id="fo5">Políticas sobre cookies</a></li>
                    <li><a href="#" id="fo6">Contáctanos</a></li>
                    <li><a href="help.php" id="fo7">Ayuda</a></li>
                </ul>
            </div>
            
            <div class="row iconos">
                <ul>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                </ul>
            </div>
        </div>
    </footer>
    
    
        <script>
            // Array de opciones de sugerencias
            // const opciones = ["programacion en python", "redes y topologias", "switch"];
            const opciones = <?php echo json_encode($ocursos); ?>;
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
                    listItem.textContent = "❌ No encontrado";
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

            // para poner un 'a' a mi img del logo
            var miImagen2 = document.getElementById('logoHome');

            // Agregamos un evento de clic a la imagen
            miImagen2.addEventListener('click', function() {
                // Redirigimos la página a "google.com" al hacer clic en la imagen
                window.location.href = 'index.php';
            });
        </script>
</body>
</html>
