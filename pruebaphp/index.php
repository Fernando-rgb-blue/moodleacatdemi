<?php
    require_once('../config.php');
    global $CFG, $OUTPUT, $PAGE, $DB, $USER;
    $redirect = $CFG->wwwroot.'/pruebaphp/index.php';
    $campos = $DB->get_records_sql("SELECT * FROM {cursosp}"); 

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js" defer></script>
    <title>Home</title>
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
        <!-- parte 1 -->
        <section class="headline">
            <div class="tamdeH1">
                <h1 id="descubre">Descubre un mundo de conocimiento tecnológico en línea</h1>
            </div>
        </section>
        <!-- mesaje de descripcion -->
        <section class="feature-container des">
            <p><strong  id="somos"> Somos una empresa dedicada a facilitar educación de calidad en línea en las áreas de <br>tecnología de la información y comunicación.</strong></p>
            <p>
                <a id="mas" href="#nosotros" class="celeste">Más información</a>
            </p>
            
        </section>

        <div class="colorblanco">
            <section class="features">
                <div class="feature-container cuatropor ini">
                    <div class="center-content">
                        <h3 class="explora ti" id="explora">Explora el futuro de la tecnología e informática con nosotros</h3>
                        <p class="explora" id="accede">Descubre productos innovadores y accede a cursos gratuitos para potenciar tus habilidades y conocimientos.</p>
                        <a href="#" class="celeste" id="registrate">Regístrate Ahora</a>
                    </div>
                </div>
                <div class="feature-container trespor ini">
                    <img src="imagenes/estudiando-re.png" alt="imágen de alguien estudiando" >
                </div>
            </section>    
        </div>
        <!-- texto antes de los cursos -->
        <section class="features dos">
            <div class="feature-container cuatropor ini">
                <div class="center-content">
                    <h3 class="explora ti" id="descubre2">Descubre Nuestros Cursos</h3>
                </div>
            </div>
        </section> 
        
        <!-- cursos -->
        <?php
            echo '<section class="features dos">';
            // Sección 1
            echo '<div class="feature-container curceleste">';
            echo '<img src="' . $campos[1]->direc . '" class="imagcurso" alt="imagen del curso 1">';
            echo '<div class="contenidocurso">';
            echo '<p id="cont1"><span class="tamcurso" id="nomc1">' . $campos[1]->titulo . '</span><br> <br>';
            echo '<b id="creador1">Un curso de ' . $campos[1]->autor . '</b><br>';
            echo '<span id="contC1">' . $campos[1]->descripcion . '</span><br>';
            echo '<br>';
            echo '<b id="contenido1">Contenido:</b> <span id="horas1">'. $campos[1]->horas . ' horas</span></p>';
            echo '</div>';
            echo '<a href="#" class="celeste curso" id="ir1">Ir al curso</a>';
            echo '</div>';


            // Sección 2
            echo '<div class="feature-container curceleste">';
            echo '<img src="' . $campos[2]->direc . '" class="imagcurso" alt="imagen del curso 2">';
            echo '<div class="contenidocurso">';
            echo '<p id="cont1"><span class="tamcurso" id="nomc2">' . $campos[2]->titulo . '</span><br> <br>';
            echo '<b id="creador2">Un curso de ' . $campos[2]->autor . '</b><br>';
            echo '<span id="contC2">' . $campos[2]->descripcion . '</span><br>';
            echo '<br>';
            echo '<b id="contenido2">Contenido:</b> <span id="horas2">'. $campos[2]->horas . ' horas</span></p>';
            echo '</div>';
            echo '<a href="#" class="celeste curso" id="ir2">Ir al curso</a>';
            echo '</div>';

            // Sección 3
            echo '<div class="feature-container curceleste">';
            echo '<img src="' . $campos[3]->direc . '" class="imagcurso" alt="imagen del curso 3">';
            echo '<div class="contenidocurso">';
            echo '<p id="cont1"><span class="tamcurso" id="nomc3">' . $campos[3]->titulo . '</span><br> <br>';
            echo '<b id="creador3">Un curso de ' . $campos[3]->autor . '</b><br>';
            echo '<span id="contC3">' . $campos[3]->descripcion . '</span><br>';
            echo '<br>';
            echo '<b id="contenido3">Contenido:</b> <span id="horas3">'. $campos[3]->horas . ' horas</span></p>';
            echo '</div>';
            echo '<a href="#" class="celeste curso" id="ir3">Ir al curso</a>';
            echo '</div>';  

            echo '</section>';

            
            echo '<section class="features dos">';
            // Sección 4
            echo '<div class="feature-container curceleste">';
            echo '<img src="' . $campos[4]->direc . '" class="imagcurso" alt="imagen del curso 4">';
            echo '<div class="contenidocurso">';
            echo '<p id="cont1"><span class="tamcurso" id="nomc4">' . $campos[4]->titulo . '</span><br> <br>';
            echo '<b id="creador4">Un curso de ' . $campos[4]->autor . '</b><br>';
            echo '<span id="contC4">' . $campos[4]->descripcion . '</span><br>';
            echo '<br>';
            echo '<b id="contenido4">Contenido:</b> <span id="horas4">'. $campos[4]->horas . ' horas</span></p>';
            echo '</div>';
            echo '<a href="#" class="celeste curso" id="ir4">Ir al curso</a>';
            echo '</div>';


            // Sección 5
            echo '<div class="feature-container curceleste">';
            echo '<img src="' . $campos[5]->direc . '" class="imagcurso" alt="imagen del curso 5">';
            echo '<div class="contenidocurso">';
            echo '<p id="cont5"><span class="tamcurso" id="nomc5">' . $campos[5]->titulo . '</span><br> <br>';
            echo '<b id="creador5">Un curso de ' . $campos[5]->autor . '</b><br>';
            echo '<span id="contC5">' . $campos[5]->descripcion . '</span><br>';
            echo '<br>';
            echo '<b id="contenido5">Contenido:</b> <span id="horas5">'. $campos[5]->horas . ' horas</span></p>';
            echo '</div>';
            echo '<a href="#" class="celeste curso" id="ir5">Ir al curso</a>';
            echo '</div>';

            // Sección 6
            echo '<div class="feature-container curceleste">';
            echo '<img src="' . $campos[6]->direc . '" class="imagcurso" alt="imagen del curso 6">';
            echo '<div class="contenidocurso">';
            echo '<p id="cont1"><span class="tamcurso" id="nomc6">' . $campos[6]->titulo . '</span><br> <br>';
            echo '<b id="creador6">Un curso de ' . $campos[6]->autor . '</b><br>';
            echo '<span id="contC6">' . $campos[6]->descripcion . '</span><br>';
            echo '<br>';
            echo '<b id="contenido6">Contenido:</b> <span id="horas6">'. $campos[6]->horas . ' horas</span></p>';
            echo '</div>';
            echo '<a href="#" class="celeste curso" id="ir6">Ir al curso</a>';
            echo '</div>';  

            echo '</section>';


        ?>
        <!-- esto esta para q no haya error en la hora de traducir -->
        <input type="text" name="country" id="autocomplete" placeholder="¿Cómo podemos ayudarte? Ejm. cursos, cuenta, pagos ..." style="display: none">

        <section class="features dos">
            <a href="#" class="vercursos" id="vercursos">Ver más cursos de Acatdemy →</a>
        </section>
        
        
        
        <!--SOBRE NOSOTROS -->
        <section class="features dos" id="nosotros">
            <div class="feature-container cuatropor ini">
                <div class="center-content">
                    <h3 class="explora ti" id="sobre">SOBRE NOSOTROS</h3>
                </div>
            </div>
        </section>
        <div class="colorblanco">
            <section class="features dos">
                
                <div class="feature-container cuatropor">
                    <div class="tabs">
                        <input type="radio" name="tabs" id="tabone" checked="checked">
                        <label for="tabone" class="op1" id="n1">Nosotros</label>
                        <div class="tab">
                            <p>
                                <span id="cont1n">Somos una empresa dedicada a facilitar educación de calidad en línea en las áreas de tecnología de la información y comunicación. </span>
                                <span id="cont12n">Ofrecemos cursos interactivos, herramientas de aprendizaje y asesoramiento personalizado para ayudar a nuestros estudiantes a prepararse para una profesión en el campo de la informática. </span>
                                <span id="cont13n">Contamos con diversos programas de estudios diseñados por expertos, además nuestra plataforma de aprendizaje en línea permite el acceso a los cursos desde cualquier lugar y en cualquier momento y estamos comprometidos en hacer del aprendizaje de la tecnología una experiencia simple, interactiva y al alcance de todos</span>
                            </p>
                        </div>
                        
                        <input type="radio" name="tabs" id="tabtwo">
                        <label for="tabtwo" class="op1" id="n2">Misión</label>
                        <div class="tab">
                            <p><span id="cont2n">Brindar educación informática accesible y efectiva a través de nuestra plataforma de aprendizaje en línea.</span>
                                <span id="cont21n"> Nos comprometemos a ofrecer cursos actualizados y relevantes dictados por expertos utilizando metodologías innovadoras y efectivas.</span>
                                <span id="cont22n"></span> Impulsamos el aprendizaje individualizado y acompañamiento personalizado de cada estudiante.
                                <span id="cont23n"> Trabajamos para transformar vidas mediante el poder educativo de la tecnología y formar profesionales preparados para los trabajos del futuro.</span></p>
                        </div>
                        
                        <input type="radio" name="tabs" id="tabthree">
                        <label for="tabthree" class="op1" id="n3">Visión</label>
                        <div class="tab">
                            <p id="cont3n">Somos una empresa que quiere situarse en los próximos años como referente en la educación informática en línea en Perú gracias a nuestra oferta de cursos de calidad, herramientas innovadoras y docentes altamente capacitados, anhelamos convertirnos en verdaderos expertos del campo informático tanto a las personas que aprueben nuestros cursos como a quienes asesoramos, para que puedan acceder a las mejores oportunidades laborales y así contribuir al desarrollo digital de nuestra sociedad en la próxima década.</p>
                        </div>
                    </div>
                </div>
                <div class="feature-container trespor">
                    <img src="que/cambiado.svg" alt="Flexbox Feature" height="150px">
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

            // inicio de busqueda
            // Array de opciones de sugerencias ocursos
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
                    default:
                        // Busca la opción seleccionada en el arreglo 'opciones'
                        const selectedIndex = opciones.findIndex(option => option === clickedSuggestion);

                        if (selectedIndex !== -1 && opciones[selectedIndex]) {
                            // Si la opción está en el arreglo y hay una URL correspondiente en linkdirec, redirige a esa URL
                            redirigirURL(opciones[selectedIndex]);
                        } else {
                            // Si la opción no se encuentra en el arreglo o no hay una URL correspondiente, redirige a home.html por defecto
                            redirigirURL("home.html");
                        }
                        break;
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
        </script>
</body>
</html>









